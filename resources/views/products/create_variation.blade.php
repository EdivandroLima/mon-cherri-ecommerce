@extends('layouts.app')
@section('title', 'Dashboard - Create Variation')
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Create Variation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Variation</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Variation Details</h4>
                    </div>
                    <div class="card-body">
                        @foreach($errors->all() as $error)
                            <span style="color:red">{{$error}}</span>

                        @endforeach
                        <form action="{{route('product.variations.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <input name="product_id" value="{{$product_id}}" hidden/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Variation</label>
                                                <select class="form-control @error('variation') is-invalid @enderror"
                                                        id="variations" data-route="" name="variations[]" multiple>
                                                    <option value="" disabled>Choose Variation</option>
                                                    @foreach(App\Variation::all() as $variation)
                                                        <option
                                                            title="{{$variation->title}}"
                                                            value="{{$variation->id}}">{{ucwords($variation->title)}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('variations'))
                                                    @foreach($errors->get('variations') as $message)
                                                        <span style="color:red">{{$message}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <select class="form-control @error('sizes') is-invalid @enderror"
                                                        id="sizes" data-route="" name="sizes[]" multiple>
                                                    <option value="" disabled>Choose Size</option>
                                                    @foreach(App\Size::all() as $size)
                                                        <option value="{{$size->id}}">{{ucwords($size->size)}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('sizes'))
                                                    @foreach($errors->get('sizes') as $message)
                                                        <span style="color:red">{{$message}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" id="variants">
                                    
                                    </div>
                                    <a href="#" id="add_variant_btn" class="link-primary"><i class="fe fe-plus"></i> Add variant</a>
                                     
                                </div>
                               
                            <!-- <div class="col-md-12">
								<div class="input-images"></div>
								<br>
								@if($errors->has('images'))
                                @foreach($errors->get('images') as $message)
                                    <span style="color:red">{{$message}}</span>
		                            @endforeach
                            @endif
                                </div> -->
                                <div class="col-md-12">

                                </div>
                            <!-- <div class="col-md-12">
								@if($errors->has('description'))
                                @foreach($errors->get('description') as $message)
                                    <span style="color:red">{{$message}}</span>
		                            @endforeach
                            @endif
                                <textarea rows="8" name="description" class="form-control summernote @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
							</div> -->
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-success bs_dashboard_btn bs_btn_color">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Products</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{route('product.variations.bulk_delete')}}" method="POST"
                                  id="deleteAll">
                                @csrf
                                <input type="hidden" name="items" id="bs_items_forbulkDelete">
                            </form>
                            <table class="datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th>S.No</th>
                                    <th>Album</th>
                                    <th>Metal Type</th>
                                    <th>Size</th>
                                    <th>Width</th>
                                    <th>Certificate</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Weight</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($variations as $variation)
                                    <tr>
                                        <form action="{{route('product.variations.edit_var')}}"
                                              method="post">
                                            @csrf
                                            
                                            <td style="padding:10px 18px;">
                                                <input type="checkbox" value="{{$variation->id}}"
                                                       class="bs_dtrow_checkbox bs_checkItem">
                                                <input value="{{$variation->id}}" hidden name="id"/>
                                            </td>

                                            <td><?=$loop->iteration?></td>
                                            <td>
                                            <select
                                                    name="album_id">
                                                    <option value="">Select Album</option>
                                                    @foreach(App\ProductAlbum::whereProductId($product_id)->get()->unique('title') as $album)
                                                        <option
                                                            title="{{$album->title}}"
                                                            value="{{$album->id}}" 
                                                            <?php
                                                            if($album->id==$variation->album_id)
                                                            {
                                                                echo 'selected';
                                                            }
                                                            
                                                            ?>
                                                             >{{ucwords($album->title)}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                {{ucwords($variation->variation->title)}}
                                            </td>
                                            <td>
                                                {{ucwords($variation->size->size)}}
                                            </td>
                                            <td>
                                            {{ucwords($variation->width->width??"")}}
                                            </td>
                                            <td>
                                            {{ucwords($variation->certificate->certificate??"")}}
                                            </td>
                                            <td>
                                                <input name="price" type="number" value="{{$variation->price}}"/>
                                            <!-- {{currency($variation->price, 'USD')}} -->
                                            </td>
                                            <td>
                                                <input name="description"
                                                       value="{{$variation->description}}"/>
                                            <!-- {{currency($variation->price, 'USD')}} -->
                                            </td>
                                            <td>
                                                <input name="qty" type="number"
                                                       value="{{$variation->qty}}"/>
                                            <!-- {{currency($variation->price, 'USD')}} -->
                                            </td>
                                            <td>
                                                <input name="weight" type="number"
                                                       value="{{$variation->weight}}"/>
                                            <!-- {{currency($variation->price, 'USD')}} -->
                                            </td>
                                            <td>{{$variation->created_at->format('d-m-Y')}}</td>
                                            <td>
                                                <div class="actions">

                                                    <button type="submit"
                                                            title="update"
                                                            class="btn btn-sm bg-success-light mr-2">
                                                        <i class="fe fe-check"></i>
                                                    </button>

                                                    <a href="{{route('product.variations.delete_var',$variation->id)}}"
                                                       class="btn btn-sm bg-danger-light bs_delete"
                                                       title="Delete"
                                                       data-route="{{route('product.variations.delete_var',$variation->id)}}">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            var variant=0
            $('#variations').select2();
            $('#sizes').select2();
            $('.input-images').imageUploader({Default: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']});
            $('#add_variant_btn').on('click',function(){
                if(variant===0)
                {
                $('#variants').html(' <div class="col-md-6"  ><div class="form-group"><label>Certificate</label> <select class="form-control @error("certificates") is-invalid @enderror"id="certificates" data-route="" name="certificates[]" multiple><option value="" disabled>Choose Certificate</option>@foreach(App\Certificate::all() as $certificate)<option value="{{$certificate->id}}">{{ucwords($certificate->certificate)}}</option>@endforeach </select> </div>  </div>');
                $('#certificates').select2();
                    variant+=1;
                }
                else
            {
                $('#variants').append(' <div class="col-md-6"><div class="form-group"><label>Width</label> <select class="form-control @error("widths") is-invalid @enderror"id="widths" data-route="" name="widths[]" multiple><option value="" disabled>Choose Width</option> @foreach(App\Width::all() as $width)<option value="{{$width->id}}">{{ucwords($width->width)}}</option>@endforeach </select> </div></div>');
                $('#widths').select2();
                $(this).hide();
            } 
            })
        })
    </script>
@endsection
