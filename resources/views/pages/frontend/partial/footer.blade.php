   <!-- ====================== footer start  =================  -->
    @php
        $webcontent = App\Models\WebContent::where('id', 1)->first();
    @endphp
   <footer id="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Address</h3>
                    <p>{{$webcontent->address}}</p>
                </div>
                <div class="col-lg-4">
                    <h3>Number</h3>
                    <p>{{$webcontent->whatsapp}}</p>
                </div>
                <div class="col-lg-4">
                    <h3>Email</h3>
                    <p>{{$webcontent->email}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom text-center">
        <p>© 2025 Website Online by Dominy</p>
    </div>
</footer>
<!-- ====================== footer end  =================  -->

