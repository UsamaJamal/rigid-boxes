@component('mail::message')
# New Quote Request

You have received a new request for a quote from the website.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] }}  
**Company Name:** {{ $data['company_name'] ?? 'N/A' }}  
**Website:** {{ $data['website'] ?? 'N/A' }}  
**Physical Address:** {{ $data['physical_address'] ?? 'N/A' }}  

### Dimensions
**Width:** {{ $data['width'] ?? 'N/A' }}  
**Length:** {{ $data['length'] ?? 'N/A' }}  
**Depth:** {{ $data['depth'] ?? 'N/A' }}  
**Units:** {{ $data['units'] ?? 'N/A' }}  

### Preferences
**Box Style:** {{ $data['box_style'] ?? 'N/A' }}
**Material:** {{ $data['material'] ?? 'N/A' }}
**Color Options:** {{ $data['color'] ?? 'N/A' }}
**Paper Coating:** {{ $data['paper_coating'] ?? 'N/A' }}
**CAD Sample:** {{ $data['cad_sample'] ?? 'N/A' }}
**Turn Around Time:** {{ $data['turn_around_time'] ?? 'N/A' }}
**Quantity:** {{ $data['quantity'] }}  

**Message:**  
{{ $data['message'] ?? 'N/A' }}

@if(!empty($data['quote_file_path']))
*(A file was attached to this request.)*
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
