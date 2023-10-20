@include('layout.header')
@include('layout.navbar')
@include('layout.sidebar')

<div class="page-body">
    <!-- Container-fluid starts-->
        <div class="container-fluid">
<div class="page-header">
<div class="row">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Tambah Data Buku</h5>
                    @include('components.flash_message')
                </div>
                <form class="form theme-form" action="/buku/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Judul</label>
                                    <input class="form-control" name="buku" id="buku" type="text" placeholder="Judul" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect9">Penerbit</label>
                                    <select class="form-select digits" name="penerbit_id" id="penerbit_id" placeholder="Penerbit" required="required">
                                        @foreach ($penerbit as $p)
                                        <option value="{{$p->id}}" >{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Foto</label>
                                    {{-- @if($buku->foto != null)
                                               <img class="rounded-circle header-profile-user"
                                               src="{{url(Storage::url($buku->foto))}}" alt="">
                                              @endif --}}
                                    <input class="form-control" name="foto" id="foto" type="file" placeholder="Foto" accept="image/*">
                                </div>
                            </div>
                        </div>

                        </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" value="Cancel" onclick="window.history.back();"/>
                    </div>
                </form>
            </div>

        </div></div>
    </div></div>
</div></div>
</div></div>
</div></div>

        @include('layout.footer')
        @include('layout.js')