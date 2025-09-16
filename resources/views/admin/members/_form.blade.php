@csrf

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Name</label>
    <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" class="border rounded w-full p-2">
    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Email</label>
    <input type="email" name="email" value="{{ old('email', $member->email ?? '') }}" class="border rounded w-full p-2">
    @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Password</label>
    <input type="password" name="password" class="border rounded w-full p-2">
    @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Confirm Password</label>
    <input type="password" name="password_confirmation" class="border rounded w-full p-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}" class="border rounded w-full p-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Address</label>
    <input type="text" name="address" value="{{ old('address', $member->address ?? '') }}" class="border rounded w-full p-2">
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Join Date</label>
    <input type="date" name="join_date" value="{{ old('join_date', isset($member->join_date) ? $member->join_date->format('Y-m-d') : '') }}" class="border rounded w-full p-2">
</div>

<div class="mb-4 flex items-center">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }} class="mr-2">
    <label>Active</label>
</div>

<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
    Submit
</button>
