<font face="Arial">
	<div>
		<div></div>
		<h3><font color="#FF9600">Thông tin khách hàng</font></h3>
		<p>
			<strong class="info">Khách Hàng: </strong>
			{{$ship->ship_name}}
		</p>
		<p>
			<strong class="info">Email: </strong>
			{{$ship->ship_email}}
		</p>
		<p>
			<strong class="info">Điện Thoại: </strong>
			{{$ship->ship_phone}}
		</p>
		<p>
			<strong class="info">Địa Chỉ: </strong>
			{{$ship->ship_address}}
		</p>
	</div>
	<div>
		<h3><font color="#FF9600">Hóa đơn mua hàng</font></h3>
		<table border="1">
			<tr>
				<td><strong>Tên sản phẩm</strong></td>
				<td><strong>Giá</strong></td>
				<td><strong>Số lượng</strong></td>
				<td><strong>Thành tiền</strong></td>
			</tr>
			@foreach ($cart as $item)
			<tr>
				<td>{{$item->name}}</td>
				<td>{{number_format($item->price,0,',',',')}}VND</td>
				<td>{{$item->qty}}</td>
				<td>{{$item->price*$item->qty}} VND</td>
			</tr>
				
			@endforeach
			<tr>
				<td colspan="4" align="right">{{$total}} VND</td>
			</tr>
		</table>
	</div>
	<div>
		<h3><font color="#FF9600">Quý khách đã đặt hàng thành công!</font></h3>
		<p>Hóa đơn mua hàng đã được chuyển đến địa chỉ Email có trong phần thông tin khách hàng của chúng tôi</p>
		<a href="http://localhost:8000/shop/shopping">Trở về trang mua hàng</a>
	</div>
</font>