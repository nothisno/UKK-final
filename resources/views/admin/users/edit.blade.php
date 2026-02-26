@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="glass-card p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white mb-2">Edit User</h2>
            <p class="text-gray-400">Perbarui informasi user: {{ $user->name }}</p>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Name -->
            <div>
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required
                       class="glass-input w-full"
                       placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="form-label" for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required
                       class="glass-input w-full"
                       placeholder="user@example.com">
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div>
                <label class="form-label" for="password">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="glass-input w-full"
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="glass-input w-full"
                       placeholder="Ulangi password">
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="form-label" for="role">Role</label>
                <select id="role" 
                        name="role" 
                        required
                        class="glass-input w-full">
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warning for self-edit -->
            @if($user->id === auth()->id())
                <div class="glass-card p-4 border-l-4 border-yellow-500 bg-yellow-500/10">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <p class="text-yellow-400 font-medium">Perhatian!</p>
                            <p class="text-gray-300 text-sm">Anda sedang mengedit akun sendiri. Perubahan role akan memengaruhi akses Anda.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
