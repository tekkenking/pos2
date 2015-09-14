<div class="ibox">
  <div class="ibox-title bg-success">
    <div class="row">
      <div class="col-sm-8">
        <h5 class="text-white inline"> Payment Details: </h5>
      </div>
      <div class="col-sm-4">
        <button class="btn btn-info pull-right title-bar-content" type="button">
            <i class="fa fa-money fa-lg"></i> Checkout
        </button>
      </div>
    </div>
  </div>
  <div class="ibox-content no-padding">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="row">
          <div class="col-sm-6">
            <strong class="pull-right font-md">Sub Total:</strong>
          </div>
          <div class="col-sm-6 text-danger">
            <strong class="font-md">{{money(1000.00)}}</strong>
          </div>
        </div>  
      </li>


      <li class="list-group-item">
        <div class="row">
          <div class="col-sm-6">
            <strong class="pull-right font-md">Overall Discount:</strong>
          </div>
          
          <div class="col-sm-6">
            <div class="input-group">
              <span class="input-group-addon">{{currency()}}</span>
              <input type="text" placeholder="0.00" class="form-control">
              <span class="input-group-addon">K</span>
            </div>
          </div>
        </div>
      </li>
      <li class="list-group-item">
    <div class="row">
      <div class="col-sm-6">
        <strong class="pull-right font-md">Total Amount:</strong>
        </div>
      <div class="col-sm-6 text-danger">
        <strong class="font-md">{{money(2000.00)}}</strong>
      </div>
    </div>  
      </li>
    </ul>
    <!--<div class="input-group">
      <input type="text" class="form-control" placeholder="Item search">
        <div class="input-group-btn">
          <select class="selectpicker" data-width="150px">
            <option selected="selected">Retailer</option>
            <option>Distributor</option>
            <option>Major Distributor</option>
            <option>Wholesale</option>
          </select>
        </div>
    </div>

    <div class="margin-top-20">
      <h4 class="inline">Search item by:</h4>
        &nbsp; &nbsp; 
        <label class=""> 
            <input type="radio" value="" name="qf" id="by_name" class="icheck"> Name 
        </label>

        <label class="pull-right"> 
            <input type="radio" value="" name="qf" id="by_barcode" class="icheck"> Barcode
        </label>
    </div>-->
  </div>
</div>