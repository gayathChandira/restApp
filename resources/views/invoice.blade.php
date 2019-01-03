<html>
    <head>
        <title>
            Invoice
        </title>
        <style>
          
            #invoice-POS{
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding:2mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
            
            
            ::selection {background: #f31544; color: #FFF;}
            ::moz-selection {background: #f31544; color: #FFF;}
            h1{
            font-size: 1.5em;
            color: #222;
            }
            h2{font-size: 1.2em;
                color: #222;}
            h3{
            font-size: 0.9em;
            font-weight: 300;
            line-height: .1em;
            color: #222;
            }
            h4{
            line-height: 0.1em;
            color: #222;  
            font-size: .6em;
            }
            p{
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
            }
            
            #top, #mid,#bot{ /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            }

            #top{min-height: 80px;}
            #mid{min-height: 60px;} 
            #bot{ min-height: 50px;}

            #top .logo{
            //float: left;
                height: 60px;
                width: 60px;
                background: url("{{asset('img/main_logo2.png')}}") no-repeat;
                background-size: 60px 60px;
            }
            .clientlogo{
            float: left;
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
                background-size: 60px 60px;
            border-radius: 50px;
            }
            .info{
            display: block;
            //float:left;
            margin-left: 0;
            }
            .title{
            float: right;
            }
            .title p{text-align: right;} 
            table{
            width: 100%;
            border-collapse: collapse;
            }
            td{
            //padding: 5px 0 5px 15px;
            //border: 1px solid #EEE
            }
            .tabletitle{
            //padding: 5px;
            font-size: .5em;
            background: #EEE;
            }
            .service{border-bottom: 1px solid #EEE;}
            .item{width: 24mm;}
            .itemtext{font-size: .6em;}

            #legalcopy{
            margin-top: 3mm;
            }

            
            
            }
        </style>
    </head>
    <body>
        

        <div id="invoice-POS">
    
            <center id="top">
              
              <div class="info"> 
                <h2>Nishan Hotel</h2>
                <h3>Nivithigala</h3>
              </div><!--End Info-->
            </center><!--End InvoiceTop-->
            
            <div id="mid">
              <div class="info">
                <h3>Contact Info</h3>
                <p> 
                    Address : 22,Main street,Nivithigala </br>
                    Email   : nishanhotel@gmail.com</br>
                    Phone   : 031493790 </br>                    
                </p>
                <h4> Bill ID : 34292 </h4>
                <h4> Date & Time : {{$bill_data->first()->created_at}} </h4>
              </div>
            </div><!--End Invoice Mid-->
            
            <div id="bot">
        
                            <div id="table">
                                <table>
                                    <tr class="tabletitle">
                                        <td class="Hours"><h2>ID</h2></td>
                                        <td class="item"><h2>Item</h2></td>
                                        <td class="Hours"><h2>Qty</h2></td>
                                        <td class="Rate"><h2>Sub Total</h2></td>
                                    </tr>
                                    @foreach($bill_data as $row)
                                  
                                    <tr class="service">
                                            <td class="tableitem"><p class="itemtext">{{$row->dish_id}}</p></td>
                                            <td class="tableitem"><p class="itemtext">{{$row->dish_name}}</p></td>
                                            <td class="tableitem"><p class="itemtext">{{$row->quantity}}</p></td>
                                            <td class="tableitem"><p class="itemtext">{{$row->price}}</p></td>
                                        </tr>
                                    @php($total =0);
                                    {{$total = $row->sum('price')}}
                                    @endforeach
                                            
                                    <tr class="tabletitle">
                                        <td></td>
                                        <td></td>
                                        <td class="Rate"><h2>Total</h2></td>
                                    <td class="payment"><h2>{{$total}}</h2></td>
                                    </tr>
        
                                </table>
                                
                            </div><!--End Table-->
                            <center>
                                <div id="legalcopy">
                                        <p class="legal"><strong>Thank you!<br> Visit Again!</strong>  
                                </div>
                            </center>
                            
        
                        </div><!--End InvoiceBot-->
          </div><!--End Invoice-->


    
    </body>
</html>



