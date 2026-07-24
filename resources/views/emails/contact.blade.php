@component('mail::message')
# New Contact Form Submission

You have received a new contact message from the website.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] }}  
**Subject:** {{ $data['subject'] ?? 'N/A' }}

**Message:**  
{{ $data['message'] ?? 'N/A' }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
