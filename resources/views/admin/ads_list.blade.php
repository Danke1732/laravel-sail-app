@extends('admin_layouts.admin_layout')
@section('site_title', '管理者ページ')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>広告一覧</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>広告（上）一覧</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link ml-5"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>画像プレビュー</th>
                        <th>画像URL</th>
                        <th>遷移先リンク</th>
                        <th></th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php $i=0; ?>
                      @foreach($ads_top_lists as $list)
                      <tr>
                        <?php $i++; ?>
                        <td>{{ $i }}</td>
                        <td class="preview"><img src="{{ $list->file_path }}"></td>
                        <td>{{ $list->file_name }}</td>
                        <td>{{ $list->link }}</td>
                        <td>
                          <a href="/admin/ads_edit/{{ $list->id }}" class="btn btn-sm btn-edit d-inline-block">編集</a>
                          <form action="{{ route('admin.ads_delete', $list->id) }}" method="POST" class="d-inline">
                          @csrf
                            <button type="submit" class="btn btn-sm btn-delete d-inline-block">削除</button>
                          </form>
                        </td>
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
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>広告（下）一覧</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link ml-5"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>画像プレビュー</th>
                        <th>画像URL</th>
                        <th>遷移先リンク</th>
                        <th></th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php $i=0; ?>
                      @foreach($ads_bottom_lists as $list)
                      <tr>
                        <?php $i++; ?>
                        <td>{{ $i }}</td>
                        <td class="preview"><img src="{{ $list->file_path }}"></td>
                        <td>{{ $list->file_name }}</td>
                        <td>{{ $list->link }}</td>
                        <td>
                          <a href="/admin/ads_edit/{{ $list->id }}" class="btn btn-sm btn-edit d-inline-block">編集</a>
                          <form action="{{ route('admin.ads_delete', $list->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-delete d-inline-block">削除</button>
                          </form>
                        </td>
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
    </div>
  </div>
</div>
@endsection