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
<body style="background-color: #f9f9f9; padding: 20px;">
    <h2 style="text-align: center; color: #8D4445; font-family: Arial, sans-serif; margin-bottom: 20px; font-size: 24px;">New Quote Request Received</h2>
    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto;">
        @if(!empty($data['name']) && $data['name'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Client Name:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['name'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['email']) && $data['email'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Client Email:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['email'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['phone']) && $data['phone'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Client Phone:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['phone'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['company_name']) && $data['company_name'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Company:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['company_name'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['website']) && $data['website'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Website:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['website'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['physical_address']) && $data['physical_address'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Physical Address:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['physical_address'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['width']) && $data['width'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Width:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['width'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['length']) && $data['length'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Length:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['length'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['depth']) && $data['depth'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Depth:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['depth'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['units']) && $data['units'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Unit:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['units'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['box_style']) && $data['box_style'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Box Style:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['box_style'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['material']) && $data['material'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Material:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['material'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['color']) && $data['color'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Color:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['color'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['paper_coating']) && $data['paper_coating'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Paper Coating:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['paper_coating'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['cad_sample']) && $data['cad_sample'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">CAD Sample:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['cad_sample'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['turn_around_time']) && $data['turn_around_time'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Turn Around Time:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['turn_around_time'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['quantity']) && $data['quantity'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Qty:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['quantity'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['message']) && $data['message'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Message:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">{{ $data['message'] }}</td>
        </tr>
        @endif
        
        @if(!empty($data['quote_file_path']) && $data['quote_file_path'] !== 'N/A')
        <tr>
            <th style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; background-color: #8D4445; color: #ffffff; width: 30%; font-weight: bold;">Attachment:</th>
            <td style="border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 14px; color: #333333; background-color: #ffffff;">A file was attached to this request.</td>
        </tr>
        @endif
    </table>
</body>
</html>
