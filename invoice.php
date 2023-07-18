<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="row md-7">
    <div class="card">
      <div class="card-body">
        <div class="container mb-5 mt-3">
          <div class="row d-flex align-items-baseline">
            <div class="col-xl-9">
              <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
            </div>
            <div class="col-xl-3 float-end">
              <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
              <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
            </div>
            <hr>
          </div>

          <div class="container">
            <div class="col-md-12">
              <div class="text-center">
                <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
              </div>

            </div>


            <div class="row">
              <div class="col-xl-8">
                <ul class="list-unstyled">
                  <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                  <li class="text-muted">Street, City</li>
                  <li class="text-muted">State, Country</li>
                  <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                </ul>
              </div>
              <div class="col-xl-4">
                <p class="text-muted">Invoice</p>
                <ul class="list-unstyled">
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#123-456</li>
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                      Unpaid</span></li>
                </ul>
              </div>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
              <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Pro Package</td>
                    <td>4</td>
                    <td>$200</td>
                    <td>$800</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Web hosting</td>
                    <td>1</td>
                    <td>$10</td>
                    <td>$10</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Consulting</td>
                    <td>1 year</td>
                    <td>$300</td>
                    <td>$300</td>
                  </tr>
                </tbody>

              </table>
            </div>
            <div class="row">
              <div class="col-xl-8">
                <p class="ms-3">Add additional notes and payment information</p>

              </div>
              <div class="col-xl-3">
                <ul class="list-unstyled">
                  <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                  <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                </ul>
                <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">$1221</span></p>
              </div>
            </div>
            <hr>


          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>"></script>
</body>

</html>