@extends('layouts.appAdmin')

@section('title', 'REPORTS - ')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h2 class="adminHeading">
                    REPORTS
                </h2>
            </div>
        </div>
        <div class="row">
          @if (Session::get('exception-error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="loginError"> {{ Session::get('exception-error') }}<span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (Session::get('report-empty'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="loginError"> {{ Session::get('report-empty') }}<span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>
      
        <div class="row mt-3">
            <div class="col-md-12">
              <form action="{{ route('admin.genarateReport') }}"  method="GET" class="row g-3 needs-validation" autocomplete="off">
                @csrf
                <div class="col-md-7">
                  <label for="report" class="form-label reportLable">Report</label>
                  <select class="form-select rounded-0 reportInput @error('report') is-invalid @enderror"  name="report">
                    <option selected disabled value="">Select Report</option>
                    <option value="SR" {{old('report') == "SR"  ? 'selected' : ''}}>Sales Report</option>
                    <option value="OR" {{old('report') == "OR"  ? 'selected' : ''}}>Order Report</option>
                    <option value="IR" {{old('report') == "IR"  ? 'selected' : ''}}>Inventory Report</option>
                    <option value="DR" {{old('report') == "DR"  ? 'selected' : ''}}>Deliver Status Report</option>
                    <option value="RI" {{old('report') == "RI"  ? 'selected' : ''}}>Orders Return Report</option>
                  </select>
                  <span class="text-danger">@error('report'){{ $message }}@enderror</span>
                </div>
    
                <div class="col-md-6">
                  <label for="formDate" class="form-label reportLable">From Date</label>
                  <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control rounded-0 reportInput @error('fromDate') is-invalid @enderror" name="fromDate" value="{{ old('fromDate') }}">
                    <span class="input-group-append">
                      <span class="input-group-text bg-white rounded-0 reportInput @error('fromDate') is-invalid border border-danger @enderror">
                        <i class="bi bi-calendar3"></i>
                      </span>
                    </span>
                  </div>
                  <span class="text-danger">@error('fromDate'){{ $message }}@enderror</span>
                </div>
    
                <div class="col-md-6">
                  <label for="toDate" class="form-label reportLable">To</label>
                  <div class="input-group date" id="datepicker2">
                    <input type="text" class="form-control rounded-0 reportInput @error('toDate') is-invalid @enderror" name="toDate" value="{{ old('toDate') }}">
                    <span class="input-group-append">
                      <span class="input-group-text bg-white rounded-0 reportInput @error('toDate') is-invalid  border border-danger @enderror">
                        <i class="bi bi-calendar3"></i>
                      </span>
                    </span>
                  </div>
                  <span class="text-danger">@error('toDate'){{ $message }}@enderror</span>
                </div>
                <div class="col-12 mt-4 reportSubmitGrid">
                  <button class="btn btn-primary rounded-0 reportSubmit" type="submit">DISPLAY</button>
                </div>
              </form>
            </div>
          </div>
</main>
    
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datepicker();
            $('#datepicker2').datepicker();
        });
    </script>    
@endsection