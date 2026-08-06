<x-app-layout>

<x-slot name="header">

<div class="flex items-center justify-between">

    <div>

        <h2 class="text-2xl font-bold">

            Academic Sessions

        </h2>

        <p class="text-slate-500">

            Manage Academic Sessions

        </p>

    </div>

    <a
        href="{{ route('academic-sessions.create') }}"
        class="px-5 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

        + New Session

    </a>

</div>

</x-slot>

<div class="py-8">

<div class="max-w-7xl mx-auto">

<div class="bg-white rounded-2xl shadow">

<table class="w-full">

<thead class="bg-slate-100">

<tr>

<th class="text-left p-4">Code</th>

<th class="text-left">Name</th>

<th>Status</th>

<th>Current</th>

<th class="text-center">Action</th>

</tr>

</thead>

<tbody>

@forelse($sessions as $session)

<tr class="border-b">

<td class="p-4">

{{ $session->code }}

</td>

<td>

{{ $session->name }}

</td>

<td>

@if($session->status=='Active')

<span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">

Active

</span>

@elseif($session->status=='Draft')

<span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full">

Draft

</span>

@else

<span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full">

Closed

</span>

@endif

</td>

<td>

@if($session->current)

<span class="text-green-600">

✔

</span>

@endif

</td>

<td>

<div class="flex justify-center gap-2">

<a
href="{{ route('academic-sessions.edit',$session) }}"
class="text-blue-600">

Edit

</a>

<form
action="{{ route('academic-sessions.destroy',$session) }}"
method="POST">

@csrf

@method('DELETE')

<button
onclick="return confirm('Delete this session?')"
class="text-red-600">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="5">

<div class="py-20 text-center">

<h3 class="text-lg font-semibold">

No Academic Session Found

</h3>

<p class="text-slate-500 mt-2">

Click "New Session" to create one.

</p>

</div>

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-6">

{{ $sessions->links() }}

</div>

</div>

</div>

</div>

</x-app-layout>
