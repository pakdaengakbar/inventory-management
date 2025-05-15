@section('title')
    {{ $pageTitle }}
@endsection
@section('page-title')
    {{ $pageDescription }}
@endsection
<div>
<style>

    .header, .content {
        margin-bottom: 20px;
    }

    .footerx {
        margin-top: 30px;
         text-align: center;
    }

    .print-btn {
        float: right;
        margin-bottom: 20px;
        background: #00c6ad;
        color: white;
        padding: 6px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    h2, h4 {
        margin: 0;
    }

    .flex-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .box {
        border: 1px solid #ddd;
        padding: 15px;
        margin-top: 15px;
        background: #f9f9f9;
        border-radius: 6px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    th {
        background: #f2f2f2;
    }

    .text-center {
        text-align: center;
    }

    .text-end {
        text-align: right;
    }

    .label {
        font-size: 12px;
        color: white;
        background: crimson;
        padding: 3px 8px;
        border-radius: 4px;
        margin-left: 8px;
    }

    .creator {
        margin-top: 30px;
        text-align: center;
    }

    @media print {
        .print-btn {
            display: none;
        }
    }
</style>
<div class="container-fluid">
<div class="card">
    <div class="card-body">
        <button class="print-btn" onclick="window.print()">Print</button>
        <div class="header">
            <h2>Internal Order</h2>
            <p><strong>Edelweiss Tea & Coffee House</strong><br>
            HO EDELWEISS CAFE<br>
            Jl. Neglasari Dalam No. 7 Ciumbuleuit<br>
            P: 0821-1123-0926<br>
            <strong style="color:#000">#IO-PST-202505-00001</strong></p>
        </div>

        <div class="flex-row box">
            <div style="flex: 1">
                <h4>INTERNAL ORDER:</h4>
                <p><strong>#IO-PST-202505-00001</strong></p>
                <p><strong>TRANS NUM:</strong> IO-PST-202505-00001</p>
                <p><strong>DATE:</strong> 15-05-2025</p>
                <p><strong>WAREHOUSE:</strong> GDG-PUSAT EDELWEISS</p>
            </div>
            <div style="flex: 1">
                <h4>HEAD OFFICE:</h4>
                <p><strong>ANEKA SOLUSI TEKNOLOGI</strong></p>
                <p><strong>ADDRESS:</strong> Jl. Daan Mogot KM.11 Gedung SSK, Cengkareng</p>
                <p><strong>PHONE:</strong> (21) 881-423</p>
                <p><strong>CITY:</strong> Jakarta Barat</p>
            </div>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Description</th>
                        <th class="text-center">Flag</th>
                        <th class="text-center">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>05181020188905 - GEMBOK UKURAN 25MM</td>
                        <td class="text-center">IO</td>
                        <td class="text-center">1</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>TOTAL:</strong></td>
                        <td class="text-center"><strong>1</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footerx">
            <div class="flex-row" style="justify-content: space-between;">
                <div>
                    <span class="label">Create By</span>
                    <p>#Date: 15-05-2025</p>
                </div>
                <div>
                    <span class="label">Approval HOD</span>
                    <p>#Date:</p>
                </div>
            </div>
            <div class="creator">
                <h5>Create By System</h5>
                <p>ADMIN PUSAT</p>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
