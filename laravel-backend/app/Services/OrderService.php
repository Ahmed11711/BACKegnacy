<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\LogsActivity;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    use LogsActivity;

    /**
     * Create order
     */
    public function create(array $data): Order
    {
        $order = Order::create($data);
        
        // Create order items
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'orderable_type' => $item['orderable_type'],
                    'orderable_id' => $item['orderable_id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);
            }
        }

        $this->logActivity('created', $order, null, $order->toArray(), "Order {$order->order_number} created");
        return $order->load('items', 'user');
    }

    /**
     * Update order
     */
    public function update(Order $order, array $data): Order
    {
        $oldValues = $order->toArray();
        $order->update($data);
        $this->logActivity('updated', $order, $oldValues, $order->toArray(), "Order {$order->order_number} updated");
        return $order->fresh(['items', 'user']);
    }

    /**
     * Get all orders with pagination
     */
    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Order::with('user', 'items');

        // User filter
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        // Status filter
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Payment status filter
        if (isset($filters['payment_status'])) {
            $query->where('payment_status', $filters['payment_status']);
        }

        // Date range
        if (isset($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (isset($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        // Sort
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Get order by ID
     */
    public function getById(int $id): ?Order
    {
        return Order::with('user', 'items.orderable', 'payments')->find($id);
    }

    /**
     * Get order by order number
     */
    public function getByOrderNumber(string $orderNumber): ?Order
    {
        return Order::where('order_number', $orderNumber)
            ->with('user', 'items.orderable', 'payments')
            ->first();
    }
}
