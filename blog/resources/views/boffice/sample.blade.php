@extends('layouts.default')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('contents')
      <article>
         <div class="conts_top">
            <h3 class="title">{{ __('messages.deposit') }}</h3>
            <a class="go_back" href="/login"><img src="/images/arr_back.png" /></a>
          </div><!-- conts_top -->
          <section class="Mywallet">
            <div class="conts_box">
               <div class="conts">
                      <div class="history_zone" id="receive_zone">
                        <div class="the_history">
                           <table cellpadding="0" cellspacing="0" border="0" class="table_list" v-for="data in items">
                                   <tbody>                                    
                                    <tr>
                                       <th class="name">{{ __('messages.address') }}</th>
                                       <td>@{{data.address}}</td>
                                    </tr>
                                    <tr>
                                       <th class="name">TXID</th>
                                       <td v-if="data.txid.indexOf('inner') != -1">@{{ data.txid}}</td>
                                       <td v-else><a v-bind:href="'http://192.241.218.5:3001/tx/' + data.txid" target="_blank">@{{data.txid}}</a></td>
                                    </tr>
                                    <tr>
                                       <th class="name">{{ __('messages.quantity') }}</th>
                                       <td><span class="counting">@{{data.quentity}}</span><span class="unit">@{{data.initializm}}</span></td>
                                    </tr>
                                    <tr>
                                       <th class="name">{{ __('messages.date') }}</th>
                                       <td>@{{data.deposit_date}}</td>
                                    </tr>
                                 </tbody>
                                  </table>
                         </div><!-- the_history -->
                          <div class="list_paging">
                           <ul>
                              <ul v-html="page_view">
                              </ul>
                           </ul>
                         </div><!-- list_paging -->
                  </div>     
               </div><!-- conts -->

            </div><!-- conts_box -->
         </section><!-- Mywallet -->
      </article>
@endsection
@section('scripts')
<script src="/js/notify.min.js"></script>
<script src="/js/vue.min.js"></script>
<script>
var receive_app = new Vue({
   el: '#receive_zone',
   data: { 
      items: [],
      page_view: '',
   },
   mounted: function(){
      this.listview(1);
   },
   methods: {
      listview: function(get_page) {
         $.ajax({
            type: 'get',
            url: '/getreceive/' + get_page,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result){
               receive_app.items = result.data;
               receive_app.page_view = result.paging_view;
            }
         });
      }
   }
});
/**/
</script>
@endsection