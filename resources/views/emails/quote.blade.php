<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #8D4445;
            color: #ffffff;
            width: 30%;
            font-weight: bold;
        }
        td {
            color: #333333;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            color: #8D4445;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
            font-size: 24px;
        }
        body {
            background-color: #f9f9f9;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2 class="header">New Quote Request Received</h2>
    <table>
        @if(!empty($data['name']) && $data['name'] !== 'N/A')
        <tr>
            <th>Client Name:</th>
            <td>{{ $data['name'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['email']) && $data['email'] !== 'N/A')
        <tr>
            <th>Client Email:</th>
            <td>{{ $data['email'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['phone']) && $data['phone'] !== 'N/A')
        <tr>
            <th>Client Phone:</th>
            <td>{{ $data['phone'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['company_name']) && $data['company_name'] !== 'N/A')
        <tr>
            <th>Company:</th>
            <td>{{ $data['company_name'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['website']) && $data['website'] !== 'N/A')
        <tr>
            <th>Website:</th>
            <td>{{ $data['website'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['physical_address']) && $data['physical_address'] !== 'N/A')
        <tr>
            <th>Physical Address:</th>
            <td>{{ $data['physical_address'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['width']) && $data['width'] !== 'N/A')
        <tr>
            <th>Width:</th>
            <td>{{ $data['width'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['length']) && $data['length'] !== 'N/A')
        <tr>
            <th>Length:</th>
            <td>{{ $data['length'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['depth']) && $data['depth'] !== 'N/A')
        <tr>
            <th>Depth:</th>
            <td>{{ $data['depth'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['units']) && $data['units'] !== 'N/A')
        <tr>
            <th>Unit:</th>
            <td>{{ $data['units'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['box_style']) && $data['box_style'] !== 'N/A')
        <tr>
            <th>Box Style:</th>
            <td>{{ $data['box_style'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['material']) && $data['material'] !== 'N/A')
        <tr>
            <th>Material:</th>
            <td>{{ $data['material'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['color']) && $data['color'] !== 'N/A')
        <tr>
            <th>Color:</th>
            <td>{{ $data['color'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['paper_coating']) && $data['paper_coating'] !== 'N/A')
        <tr>
            <th>Paper Coating:</th>
            <td>{{ $data['paper_coating'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['cad_sample']) && $data['cad_sample'] !== 'N/A')
        <tr>
            <th>CAD Sample:</th>
            <td>{{ $data['cad_sample'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['turn_around_time']) && $data['turn_around_time'] !== 'N/A')
        <tr>
            <th>Turn Around Time:</th>
            <td>{{ $data['turn_around_time'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['quantity']) && $data['quantity'] !== 'N/A')
        <tr>
            <th>Qty:</th>
            <td>{{ $data['quantity'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['message']) && $data['message'] !== 'N/A')
        <tr>
            <th>Message:</th>
            <td>{{ $data['message'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['quote_file_path']) && $data['quote_file_path'] !== 'N/A')
        <tr>
            <th>Attachment:</th>
            <td>A file was attached to this request.</td>
        </tr>
        @endif
    </table>
</body>
</html>
