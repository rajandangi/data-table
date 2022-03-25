<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="./css/responsive.bootstrap4.min.css" />
    <style type="text/css">
           @media (min-width:1200px){.container,.container-lg,.container-md,.container-sm,.container-xl{max-width:1200px}}.grid tr:nth-child(even){background:#fff}.grid tr:nth-child(odd){background:#f9fafa}.grid td{border:1px solid #e4e4e4;color:#000;font-size:13px;height:10px}.grid th{background:#fff;text-align:center;color:#000;height:10px;font-size:13px;font-weight:600;border:1px solid #e4e4e4}.gv{overflow-x:scroll}
    </style>
</head>
<body>
  <div class="container">
    <div class="py-3 text-center">
      <img class="d-block mx-auto mb-2" src="./img/logo.png" alt="Nabil Bank" class="img-fluid" width="220px">
      <p class="lead">NOC Records</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gv">
                    <table id="datatable_example" class="table table-striped table-bordered grid" style="width:100%">
                        <thead>
                            <tr>
                                <th>CUSTOMER CODE</th>
                                <th>FINACLE CODE</th>
                                <th>CUSTOMER NAME</th>
                                <th>MOBILE NUMBER</th>
                                <th>PAN NUMBER</th>
                                <th>CUSTOMER ADDRESS</th>
                            </tr>
                        </thead>
                       
                        <tfoot>
                            <tr>
                                <th>CUSTOMER CODE</th>
                                <th>FINACLE CODE</th>
                                <th>CUSTOMER NAME</th>
                                <th>MOBILE NUMBER</th>
                                <th>PAN NUMBER</th>
                                <th>CUSTOMER ADDRESS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Copyright &copy; 2022 Nabil Bank Limited. All Rights Reserved.</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Designed and Maintined by IT Department</a></li>
        </ul>
      </footer>
    <script type="text/javascript" src="./js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable_example').dataTable({
                "bProcessing": true,
                "serverSide": true,
                "ajax": {
                    url: 'server.php',
                    error: function() {}
                },
                "columns": [
                    {
                        "data": "CUSTOMER_CODE"
                    },
                    {
                        "data": "FINACLE_CODE"
                    },
                    {
                        "data": "CUSTOMER_NAME"
                    },
                    {
                        "data": "MOBILE_NUMBER"
                    },
                    {
                        "data": "PAN_NUMBER"
                    },
                    {
                        "data": "CUSTOMER_ADDRESS"
                    }
                ]
            });
        });
    </script>
</body>
</html>