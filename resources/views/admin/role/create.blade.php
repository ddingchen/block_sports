@extends('admin.layout')

@section('page-title', '添加管理员')

@section('content')
<h3>添加管理员</h3>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">搜索</span>
  <input type="text" class="form-control" placeholder="用户搜索关键词" aria-describedby="basic-addon1"
  v-model="keyword"
  @change="keywordInput">
</div>
<div class="list-group">
  <a href="#" class="list-group-item"
  v-for="user in result"
  @click="userSelect(user)"
  >@{{ user.nickname + (user.name ? ' - ' + user.name : '') }}</a>
</div>
<div class="list-group">
  <a href="#" class="list-group-item"
  v-for="request in requests"
  @click="requestSelect(request)"
  >@{{ request.user.nickname + (request.user.name ? ' - ' + request.user.name : '') + ' - ' + request.note }}
  </a>
</div>
<form class="form-inline" method="post" action="/admin/role">
  {{ csrf_field() }}
  <div class="form-group">
    <input type="text" class="form-control" :value="selectedUser.nickname" placeholder="帐号">
    <input type="hidden" name="user_id" :value="selectedUser.id">
    <input type="text" class="form-control" name="password" placeholder="密码">
    <input type="text" class="form-control" name="name" placeholder="管理帐号名称" :value="selectedRequest.note">
  </div>
  <button type="submit" class="btn btn-primary">设置为管理员</button>
</form>
@endsection

@section('page-js')
<script src="http://cdn.bootcss.com/vue/2.2.1/vue.js"></script>
<script type="text/javascript">
  var vm = new Vue({
    el: '.container',
    data: {
      keyword: '',
      result: [],
      requests: [],
      selectedUser: {
      	id: 0
      },
      selectedRequest: {}
    },
    mounted: function() {
      $.getJSON('/admin/request', function(requests) {
        this.requests = requests
      }.bind(this))
    },
    methods: {
      keywordInput: function() {
        $.get('/admin/user', {
        	keyword: this.keyword
        }, function(res) {
        	this.result = res
        }.bind(this), 'json');
      },
      userSelect: function(user) {
      	this.selectedUser = user
      },
      requestSelect: function(request) {
        this.selectedRequest = request
        this.selectedUser = request.user
      }
    }
  })
</script>
@endsection
