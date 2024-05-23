
@csrf
<label for="name">Name:</label>
<input type="text" name="name" id="name" value="{{ old('name', $entry->name ?? '') }}" required>

<label for="address">Address:</label>
<input type="text" name="address" id="address" value="{{ old('address', $entry->address ?? '') }}" required>

<label for="phone">Phone:</label>
<input type="text" name="phone" id="phone" value="{{ old('phone', $entry->phone ?? '') }}" required>

<button type="submit">Save Entry</button>
