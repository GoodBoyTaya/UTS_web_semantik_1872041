@extends('layouts.app')
@section('ajax')
<script type="text/javascript">
    $(document).ready(function(){
      getDataTable('')
    })
    $('#btnSubmit').on('click',function(){
      getDataTable($('#searchrss').val())
    })
    getDataTable = (search) =>{
      $('#isitabelrss').html('')
      $.ajax({
        type: 'GET',
        url: "{{ url('rss') }}",
        data: {search: search},
        success: function(data) {
          for (var i=0;i<data.news.length;i++) {
            $('#isitabelrss')
            .append($('<tr>')
            .append($('<td>').html(data.news[i].sauce))
            .append($('<td>').html(data.news[i].title))
            .append($('<td>').html('<a href="'+ data.news[i].link +'">'+ data.news[i].link +'</a>'))
            )
          }
        }
      })
    }
  </script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12" action="" method="get">
                      <div class="row">
                        <input type="text" id="searchrss" name="search" class="form-control col-md-4" placeholder="Cari Judul Berita">
                        <button type="button" id="btnSubmit" class="btn btn-primary">Cari</button>
                      </div>
                    </form>
                    <br>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sumber</th>
                          <th>Judul</th>
                          <th>Link</th>
                        </tr>
                      </thead>
                      <tbody id ="isitabelrss">
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

