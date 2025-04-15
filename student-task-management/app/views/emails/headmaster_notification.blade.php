<h2>New Student Created</h2>
<p>Name: {{ $student->user->name }}</p>
<p>Email: {{ $student->user->email }}</p>
<p>Class: {{ $student->class }}, Section: {{ $student->section }}</p>
<p>Best regards,</p>
<p>The {{ config('app.name') }} Team</p>
