@extends('layouts.app')

@section('content')
    <!-- page path -->
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="#">HOME</a><img src="img/rigthArrow.png"
              class="pathArrowHead">SUPPORT</p>
        </div>
      </div>
    </div>
  </div>
  <!-- page path end -->

  <!-- Contact section -->
  <div class="container" id="contact">
    <div class="row">
      <div class="col-lg-12 m-auto">
        <h2 class="SupportPageHeading">Contact</h2>
        <hr class="SupportPageHr">
        <p class="SupportPagePara"> Email Us: FlipFlop@gmail.com <br>
          Need to speak with someone? <br>
          "Our customer care team is redy to pick up the phone! <br>
          Sri Lanka: +96 0775656456/ 0112789453"
        </p>
      </div>
    </div>
  </div>
  <!-- Contact section  end-->

  <!-- Exchange and Refund Policy section -->
  <div class="container" id="exchange">
    <div class="row">
      <div class="col-lg-12 m-auto">
        <h2 class="SupportPageHeading">Exchange and Refund Policy</h2>
        <hr class="SupportPageHr">
        <p class="SupportPagePara">
          <b>Please find details regarding the return and refund policies for Flipflop bellow. We
            encourage you to leave an email FlipFlop@gmail.com regarding your experience requesting a return from Flipflop Online Store.</b>
            <ul class="SupportPagePara">
              <li>Exchanges are done strictly within 7 days after the delivery is completed.</li>
              <li>All items should be new, unused, and with all brand price tags on the garment still attached. Items that are damaged, unhygienic, soiled or altered may not be accepted and your exchange will be rejected.</li>
              <li>The purchased item(s) are the customer’s responsibility until they reach the Flipflop team for inspection. The Flipflop team requests the customer to ensure that the items are packed and sealed up properly
                for exchange to avoid damage and tampering on their way to the store.</li>
              <li>All exchange items will be inspected once we receive them before we can complete an exchange request. We try hard to accept all items returned to us to serve you better, but request that all returned items
                should pass our inspection for points mentioned above.</li>
              <li>Item(s) can be exchanged for a different size, or an alternative product(s), subject to availability of stock. The exchange will be free of charge if the item passes our inspection.</li>
              <li>Please note that <b> NO cash refunds or Credit Notes are extended to customers for any item exchanges.</b> </li>
              <li>If the new item that you are requesting an exchange for has a Higher Selling Price than the original purchase item – you will be requested to make an additional payment to cover the difference in price.</li>
              <li>Lower Selling Price than the original purchase item – the balance money will not be refunded to you, and you will forego that difference.</li>
              <li>In the unlikely event that an item is returned to us in an unsuitable condition, we may have to send it back to you. In this case, you will not be entitled for an exchange, and you will have to bear the
                courier charges for the pickup and return.</li>
              <li>Once the inspection is passed and the exchange is accepted, Relevant courier charges must pay by the customer again. Therefore, we highly recommend going through our size charts properly before the order.</li>
              <li>Please note that all exchanges will take a period of 14 days to accommodate the courier return time, inspection time, product processing and courier delivery time. Your patience is highly appreciated.</li>
              <li>Sale items purchased online cannot be exchanged under any circumstances.</li>
            </ul>
        </p>
      </div>
    </div>
  </div>
  <!-- Exchange and Refund Policye section  end-->

  <!-- Size Charts section -->
  <div class="container mb-5" id="size">
   <div class="row">
     <div class="col-lg-12 m-auto">
        <h2 class="SupportPageHeading">Size Charts</h2>
        <hr class="SupportPageHr">
        <!-- table -->
      <div class="bd-example">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Lable Size</th>
                <th scope="col">UK/India</th>
                <th scope="col">EU</th>
                <th scope="col">USA</th>
                <th scope="col">Foot Length</th>
                <th scope="col">Foot Length</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>3</td>
                <td>3</td>
                <td>35.5</td>
                <td>4.5</td>
                <td>22.0</td>
                <td>8.66</td>
              </tr>
              <tr>
                <td>4</td>
                <td>4</td>
                <td>36.65</td>
                <td>5.5</td>
                <td>22.9</td>
                <td>9.01</td>
              </tr>
              <tr>
                <td>5</td>
                <td>5</td>
                <td>38</td>
                <td>6.5</td>
                <td>23.7</td>
                <td>9.33</td>
              </tr>
              <tr>
                <td>6</td>
                <td>6</td>
                <td>39.33</td>
                <td>7.5</td>
                <td>24.6</td>
                <td>9.58</td>
              </tr>
              <tr>
                <td>7</td>
                <td>7</td>
                <td>40.67</td>
                <td>8.5</td>
                <td>25.4</td>
                <td>10.00</td>
              </tr>
              <tr>
                <td>8</td>
                <td>8</td>
                <td>42</td>
                <td>9.5</td>
                <td>26.2</td>
                <td>10.31</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- table end -->
      </div>
    </div>
  </div>
  <!-- Size Charts section  end-->
@endsection