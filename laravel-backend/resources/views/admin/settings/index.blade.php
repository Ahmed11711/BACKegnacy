@extends('layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('page-description', 'Manage site-wide settings')

@section('content')
<div class="max-w-4xl">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
            @csrf
            @method('PUT')

            @foreach($settings as $group => $groupSettings)
            <div class="border-b border-white/10 pb-8 last:border-b-0 last:pb-0">
                <h3 class="text-xl font-bold text-white mb-6 capitalize">{{ str_replace('_', ' ', $group) }}</h3>
                
                <div class="space-y-6">
                    @foreach($groupSettings as $setting)
                    <div>
                        <label for="setting_{{ $setting->key }}" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                            @if($setting->description)
                            <span class="text-xs text-gray-500 font-normal">({{ $setting->description }})</span>
                            @endif
                        </label>
                        
                        @if($setting->type === 'textarea')
                        <textarea 
                            id="setting_{{ $setting->key }}" 
                            name="settings[{{ $setting->key }}][value]" 
                            rows="4"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        >{{ old('settings.' . $setting->key . '.value', $setting->value) }}</textarea>
                        @elseif($setting->type === 'boolean')
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="setting_{{ $setting->key }}" 
                                name="settings[{{ $setting->key }}][value]" 
                                value="1"
                                {{ old('settings.' . $setting->key . '.value', $setting->value) ? 'checked' : '' }}
                                class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                            >
                            <label for="setting_{{ $setting->key }}" class="ml-2 text-sm text-gray-300">Enabled</label>
                        </div>
                        @elseif($setting->type === 'image')
                        <div class="space-y-3">
                            <input 
                                type="file" 
                                id="setting_{{ $setting->key }}" 
                                name="settings[{{ $setting->key }}][file]"
                                accept="image/*"
                                class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            >
                            @if($setting->value)
                            <div>
                                <p class="text-xs text-gray-400 mb-2">Current:</p>
                                <img src="{{ asset('storage/' . $setting->value) }}" alt="Setting image" class="size-32 rounded-lg object-cover">
                                <input type="hidden" name="settings[{{ $setting->key }}][value]" value="{{ $setting->value }}">
                            </div>
                            @endif
                        </div>
                        @else
                        <input 
                            type="text" 
                            id="setting_{{ $setting->key }}" 
                            name="settings[{{ $setting->key }}][value]" 
                            value="{{ old('settings.' . $setting->key . '.value', $setting->value) }}"
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        >
                        @endif
                        
                        <input type="hidden" name="settings[{{ $setting->key }}][key]" value="{{ $setting->key }}">
                        <input type="hidden" name="settings[{{ $setting->key }}][type]" value="{{ $setting->type }}">
                        <input type="hidden" name="settings[{{ $setting->key }}][group]" value="{{ $setting->group }}">
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="flex items-center gap-4 pt-6 border-t border-white/10">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-8 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
