<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaction_code }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; }
        .invoice-info { text-align: right; }
        .customer-info { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table th { background-color: #f5f5f5; }
        .text-right { text-align: right; }
        .total { font-size: 18px; font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
        .company-info { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="company-info">
            <h1>{{ $company_name }}</h1>
            <p>{{ $company_address }}</p>
            <p>Telp: {{ $company_phone }}</p>
        </div>
        
        <div class="header">
            <div class="logo">INVOICE</div>
            <div class="invoice-info">
                <p><strong>No. Invoice:</strong> #{{ $transaction_code }}</p>
                <p><strong>Tanggal:</strong> {{ $date }}</p>
            </div>
        </div>
        
        <div class="customer-info">
            <h3>Kepada:</h3>
            <p><strong>{{ $customer_name }}</strong></p>
            <p>{{ $customer_email }}</p>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right total">Total</td>
                    <td class="total">Rp{{ number_format($total_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        
        <div class="footer">
            <p>Terima kasih telah berbelanja di {{ $company_name }}!</p>
            <p>Invoice ini sah dan diproses oleh komputer</p>
        </div>
    </div>
</body>
</html>