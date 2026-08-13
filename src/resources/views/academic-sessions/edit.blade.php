<x-app-layout>

<x-slot name="header">

<div>
<h2 class="text-2xl font-bold text-slate-800">
Academic Sessions
</h2>
</div>

</x-slot>

<div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
<div>
<h2 class="text-2xl font-bold text-slate-800">
Edit Academic Session
</h2>
<p class="mt-1 text-sm text-slate-500">
Update academic session information.
</p>
</div>
</div>

<div class="py-8">

<div class="max-w-6xl mx-auto">

<div class="bg-white rounded-2xl shadow p-8">

<form

action="{{ route('academic-sessions.update',$academicSession) }}"

method="POST">

@csrf

@method('PUT')

@include('academic-sessions.form')

</form>

</div>

</div>

</div>

</x-app-layout>
