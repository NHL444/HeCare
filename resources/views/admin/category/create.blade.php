
            <form class="form-horizontal form-label-left" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Danh Mục</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="cate_name" placeholder="Nhập Tên Danh Mục Mới" value="{{old('cate_name')}}">
                        @error('cate_name')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Danh Mục Cha</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="cate_parent" class="form-control" style="border: 1px solid; width: 150px;">
                            <option value="0">Là Danh Mục Cha</option>
                        @foreach($cate as $key => $data)                           
                            <option value="{{$data->cate_id}}">
                            @php
                             $str = '';
                             for($i = 0;$i < $data->level ; $i++){
                                echo $str;
                                $str.='-- ';
                             }   
                            @endphp
                                {{$data->cate_name}}</option>
                                              
                        @endforeach     
                        </select>
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                    </div>
                </div>
            </form>
        