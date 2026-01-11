<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    /**
     * Display a listing of orders
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['user_id', 'status', 'payment_status', 'date_from', 'date_to', 'sort_by', 'sort_order']);
        
        // If user is not admin, only show their orders
        if (!$request->user()->isAdmin()) {
            $filters['user_id'] = $request->user()->id;
        }

        $perPage = $request->get('per_page', 15);
        $orders = $this->orderService->getAll($filters, $perPage);

        return response()->json([
            'data' => OrderResource::collection($orders->items()),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    /**
     * Store a newly created order
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        // Calculate totals
        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += $item['quantity'] * $item['price'];
        }
        $data['subtotal'] = $subtotal;
        $data['tax'] = $data['tax'] ?? 0;
        $data['shipping'] = $data['shipping'] ?? 0;
        $data['discount'] = $data['discount'] ?? 0;
        $data['total'] = $subtotal + $data['tax'] + $data['shipping'] - $data['discount'];

        $order = $this->orderService->create($data);

        return response()->json([
            'message' => 'Order created successfully',
            'data' => new OrderResource($order),
        ], 201);
    }

    /**
     * Display the specified order
     */
    public function show(Request $request, Order $order): JsonResponse
    {
        // Check if user can view this order
        if (!$request->user()->isAdmin() && $order->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order = $this->orderService->getById($order->id);

        return response()->json([
            'data' => new OrderResource($order),
        ]);
    }

    /**
     * Update the specified order
     */
    public function update(Request $request, Order $order): JsonResponse
    {
        $request->validate([
            'status' => 'sometimes|in:pending,processing,shipped,delivered,cancelled,refunded',
            'payment_status' => 'sometimes|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $order = $this->orderService->update($order, $request->only(['status', 'payment_status', 'notes']));

        return response()->json([
            'message' => 'Order updated successfully',
            'data' => new OrderResource($order),
        ]);
    }
}
