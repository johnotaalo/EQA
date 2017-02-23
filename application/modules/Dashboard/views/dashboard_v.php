<?php $assets_url = $this->config->item('assets_url');?>
<script>var pxInit = [];</script>


  <script>
    pxInit.push(function() {
      $('#navbar-notifications').perfectScrollbar();
      $('#navbar-messages').perfectScrollbar();
    });
  </script>

  <!-- Custom styling -->
  <style>
    .page-header-form .input-group-addon,
    .page-header-form .form-control {
      background: rgba(0,0,0,.05);
    }
  </style>
  <!-- / Custom styling -->

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="index.html">Home</a></li>
      <li class="active">Dashboard</li>
    </ol>

    <div class="page-header">
      <div class="row">
        <div class="col-md-4 text-xs-center text-md-left text-nowrap">
          <h1><i class="page-header-icon ion-ios-pulse-strong"></i>Dashboard</h1>
        </div>

        <hr class="page-wide-block visible-xs visible-sm">

        <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right">
          <a href="#" class="btn btn-primary btn-block"><span class="btn-label-icon left ion-plus-round"></span>Create project</a>
        </div>

        <!-- Spacer -->
        <div class="m-b-2 visible-xs visible-sm clearfix"></div>

        <form action="#" class="page-header-form col-xs-12 col-md-4 pull-md-right">
          <div class="input-group">
            <span class="input-group-addon b-a-0 font-size-16"><i class="ion-search"></i></span>
            <input type="text" placeholder="Search..." class="form-control p-l-0 b-a-0">
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">

        <!-- Uploads -->

        <div class="panel box">
          <div class="box-row">
            <div class="box-cell col-md-4 p-a-3 valign-top">
              <h4 class="m-y-1 font-weight-normal"><i class="fa fa-cloud-upload text-primary"></i>&nbsp;&nbsp;Uploads</h4>
              <ul class="list-group m-x-0 m-t-3 m-b-0">
                <li class="list-group-item p-x-1 b-x-0 b-t-0">
                  <span class="label label-primary pull-right">34</span>
                  Documents
                </li>
                <li class="list-group-item p-x-1 b-x-0">
                  <span class="label label-danger pull-right">128</span>
                  Audio
                </li>
                <li class="list-group-item p-x-1 b-x-0 b-b-0">
                  <span class="label label-info pull-right">12</span>
                  Videos
                </li>
              </ul>
            </div>
            <div class="box-cell col-md-8 p-a-1 bg-primary">
              <div id="hero-graph" style="height: 220px;"></div>
            </div>
          </div>
        </div>

        <script>
          pxInit.push(function() {
            var data = [
              { day: '2014-03-10', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-11', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-12', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-13', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-14', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-15', v: pxDemo.getRandomData(20, 5) },
              { day: '2014-03-16', v: pxDemo.getRandomData(20, 5) }
            ];

            new Morris.Line({
              element: 'hero-graph',
              data: data,
              xkey: 'day',
              ykeys: ['v'],
              labels: ['Value'],
              lineColors: ['#fff'],
              lineWidth: 2,
              pointSize: 4,
              gridLineColor: 'rgba(255,255,255,.5)',
              resize: true,
              gridTextColor: '#fff',
              xLabels: "day",
              xLabelFormat: function(d) {
                return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
              },
            });
          });
        </script>

        <!-- / Uploads -->

        <!-- Pie charts -->

        <div class="row">

          <div class="col-xs-12 col-sm-4">
            <div class="panel box">
              <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                  <i class="fa fa-globe"></i>&nbsp;&nbsp;BANDWIDTH
                </div>
              </div>
              <div class="box-row">
                <div class="box-cell p-y-2">
                  <div class="easy-pie-chart" data-suffix="TB" id="easy-pie-chart-1"><span class="font-size-14 font-weight-light"></span></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-4">
            <div class="panel box">
              <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                  <i class="fa fa-flash"></i>&nbsp;&nbsp;PICK LOAD
                </div>
              </div>
              <div class="box-row">
                <div class="box-cell p-y-2">
                  <div class="easy-pie-chart" data-suffix="%" id="easy-pie-chart-2"><span class="font-size-14 font-weight-light"></span></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-4">
            <div class="panel box">
              <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                  <i class="fa fa-cloud"></i>&nbsp;&nbsp;USED RAM
                </div>
              </div>
              <div class="box-row">
                <div class="box-cell p-y-2">
                  <div class="easy-pie-chart" data-suffix="GB" id="easy-pie-chart-3"><span class="font-size-14 font-weight-light"></span></div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <script>
          pxInit.push(function () {
            $(function() {
              var colors = pxDemo.getRandomColors();

              var config = {
                animate: 2000,
                scaleColor: false,
                lineWidth: 4,
                lineCap: 'square',
                size: 90,
                trackColor: 'rgba(0, 0, 0, .09)',
                onStep: function(_from, _to, currentValue) {
                  var value = $(this.el).attr('data-max-value') * currentValue / 100;

                  $(this.el)
                    .find('> span')
                    .text(Math.round(value) + $(this.el).attr('data-suffix'));
                },
              }

              var data = [
                pxDemo.getRandomData(1000, 1),
                pxDemo.getRandomData(100, 1),
                pxDemo.getRandomData(64, 1),
              ];

              $('#easy-pie-chart-1')
                .attr('data-percent', (data[0] / 1000) * 100)
                .attr('data-max-value', 1000)
                .easyPieChart($.extend({}, config, { barColor: colors[0] }));

              $('#easy-pie-chart-2')
                .attr('data-percent', (data[1] / 100) * 100)
                .attr('data-max-value', 100)
                .easyPieChart($.extend({}, config, { barColor: colors[1] }));

              $('#easy-pie-chart-3')
                .attr('data-percent', (data[2] / 64) * 100)
                .attr('data-max-value', 64)
                .easyPieChart($.extend({}, config, { barColor: colors[2] }));
            });
          });
        </script>

        <!-- / Pie charts -->

      </div>
      <div class="col-md-4">

        <!-- Stats -->

        <a href="#" class="box bg-danger">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-arrow-graph-up-right"></i>

            <span class="font-size-24">$<strong>145</strong></span><br>
            <span class="font-size-15">Earned today</span>
          </div>
        </a>

        <div class="panel box">
          <div class="box-row">
            <div class="box-container">
              <div class="box-cell p-a-1 bg-info">
                <div class="m-b-1 font-size-11">RETWEETS GRAPH</div>
                <div id="sparkline-1"></div>
              </div>
            </div> <!-- / .box-container -->
          </div>
          <div class="box-row">
            <div class="box-container valign-middle text-xs-center">
              <div class="box-cell p-y-1 b-r-1">
                <div class="font-size-17"><strong>312</strong></div>
                <div class="font-size-11">TWEETS</div>
              </div>
              <div class="box-cell p-y-1 b-r-1">
                <div class="font-size-17"><strong>1000</strong></div>
                <div class="font-size-11">FOLLOWERS</div>
              </div>
              <div class="box-cell p-y-1">
                <div class="font-size-17"><strong>523</strong></div>
                <div class="font-size-11">FOLLOWING</div>
              </div>
            </div> <!-- / .box-container -->
          </div>
        </div>

        <script>
          pxInit.push(function() {
            var data = [
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
              pxDemo.getRandomData(300, 100),
            ];

            $("#sparkline-1").pxSparkline(data, {
              type: 'line',
              width: '100%',
              height: '42px',
              fillColor: '',
              lineColor: '#fff',
              lineWidth: 2,
              spotColor: '#ffffff',
              minSpotColor: '#ffffff',
              maxSpotColor: '#ffffff',
              highlightSpotColor: '#ffffff',
              highlightLineColor: '#ffffff',
              spotRadius: 4,
            });
          });
        </script>

        <div class="box bg-warning">
          <div class="box-row">
            <div class="box-cell p-a-2">
              <div class="font-weight-semibold font-size-17">15% more</div>
              <div class="font-size-12">Monthly visitor statistics</div>
            </div>
          </div>
          <div class="box-row">
            <div class="box-cell p-x-2 p-b-1 valign-bottom text-xs-center">
              <span id="sparkline-2"></span>
            </div>
          </div>
        </div>

        <script>
          pxInit.push(function() {
            $(function() {
              var data = [
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
                pxDemo.getRandomData(300, 100),
              ];

              $("#sparkline-2").pxSparkline(data, {
                type: 'bar',
                height: '42px',
                width: '100%',
                barSpacing: 2,
                zeroAxis: false,
                barColor: '#ffffff',
              });
            });
          });
        </script>

        <!-- / Stats -->

      </div>
    </div>

    <hr class="page-block m-t-0">

    <div class="row">
      <div class="col-md-6">

        <!-- Support tickets -->

        <div class="panel panel-success">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Support tickets</span>
            <div class="panel-heading-controls">
              <div class="panel-heading-text">
                <a  href="#">15 new tickets</a>
              </div>
            </div>
          </div>

          <div id="support-tickets" class="ps-block" style="height: 300px">
            <div class="widget-support-tickets-item">
              <span class="label label-success pull-right">Completed</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Server unavaible
                <span class="widget-support-tickets-id">[#201798]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#" title="">Timothy Owens</a> today</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-warning pull-right">Pending</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Mobile App Problem
                <span class="widget-support-tickets-id">[#201797]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Denise Steiner</a> 2 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-info pull-right">In progress</span>
              <a href="#" title="" class="widget-support-tickets-title">
                <i class="fa fa-warning text-danger"></i> PayPal issue
                <span class="widget-support-tickets-id">[#201796]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Robert Jang</a> 3 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-danger pull-right">Rejected</span>
              <a href="#" title="" class="widget-support-tickets-title">
                IE8 problem
                <span class="widget-support-tickets-id">[#201795]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Robert Jang</a> 4 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-success pull-right">Completed</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Server unavaible
                <span class="widget-support-tickets-id">[#201794]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Timothy Owens</a> 5 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-success pull-right">Completed</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Server unavaible
                <span class="widget-support-tickets-id">[#201798]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#" title="">Timothy Owens</a> today</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-warning pull-right">Pending</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Mobile App Problem
                <span class="widget-support-tickets-id">[#201797]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Denise Steiner</a> 2 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-info pull-right">In progress</span>
              <a href="#" title="" class="widget-support-tickets-title">
                <i class="fa fa-warning text-danger"></i> PayPal issue
                <span class="widget-support-tickets-id">[#201796]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Robert Jang</a> 3 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-danger pull-right">Rejected</span>
              <a href="#" title="" class="widget-support-tickets-title">
                IE8 problem
                <span class="widget-support-tickets-id">[#201795]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Robert Jang</a> 4 days ago</span>
            </div>

            <div class="widget-support-tickets-item">
              <span class="label label-success pull-right">Completed</span>
              <a href="#" title="" class="widget-support-tickets-title">
                Server unavaible
                <span class="widget-support-tickets-id">[#201794]</span>
              </a>
              <span class="widget-support-tickets-info">Opened by <a href="#">Timothy Owens</a> 5 days ago</span>
            </div>
          </div>

        </div>

        <script>
          pxInit.push(function() {
            $(function() {
              $('#support-tickets').perfectScrollbar();
            });
          });
        </script>

        <!-- / Support tickets -->

      </div>
      <div class="col-md-6">

        <!-- Recent comments / threads -->

        <div class="panel panel-warning">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-fire text-danger"></i>Recent</span>
            <ul class="nav nav-tabs nav-xs">
              <li class="active"><a href="#comments" data-toggle="tab">Comments</a></li>
              <li><a href="#threads" data-toggle="tab">Forum threads</a></li>
            </ul>
          </div>

          <div class="tab-content p-a-0">
            <div id="comments" class="ps-block tab-pane fade in active" style="height: 300px">
              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/5.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Denise Steiner</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Michelle Bortz</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Robert Jang</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Timothy Owens</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>
              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/5.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Denise Steiner</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Michelle Bortz</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Robert Jang</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>

              <div class="widget-comments-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-comments-avatar">
                <div class="widget-comments-header">
                  <a href="#" title="">Timothy Owens</a> commented on <a href="#" title="">Article Name</a>
                </div>
                <div class="widget-comments-text">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                </div>
                <div class="widget-comments-footer">
                  2 hours ago
                  <div class="pull-right">
                    <a href="#"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                    <a href="#"><i class="fa fa-times"></i>&nbsp;Remove</a>
                  </div>
                </div>
              </div>
            </div>

            <div id="threads" class="ps-block tab-pane fade" style="height: 300px">
              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Robert Jang</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Michelle Bortz</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Timothy Owens</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/5.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Denise Steiner</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Robert Jang</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Michelle Bortz</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Timothy Owens</a> in <a href="#" title="">Forum name</a></div>
              </div>
              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Robert Jang</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Michelle Bortz</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Timothy Owens</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/5.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Denise Steiner</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Robert Jang</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Michelle Bortz</a> in <a href="#" title="">Forum name</a></div>
              </div>

              <div class="widget-threads-item">
                <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" class="widget-threads-avatar">
                <span class="widget-threads-date">14h</span>
                <a href="#" class="widget-threads-title">Lorem ipsum dolor sit amet</a>
                <div class="widget-threads-info">started by <a href="#" title="">Timothy Owens</a> in <a href="#" title="">Forum name</a></div>
              </div>

            </div>
          </div>
        </div>

        <script>
          pxInit.push(function() {
            $(function() {
              $('#comments').perfectScrollbar();
              $('#threads').perfectScrollbar();
            });
          });
        </script>

        <!-- / Recent comments / threads -->

      </div>
    </div>

    <hr class="page-block m-t-0">

    <div class="row">
      <div class="col-md-7">

        <!-- New users -->

        <div class="panel panel-danger panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>New users</span>
            <div class="panel-heading-controls">
              <ul class="pagination pagination-xs">
                <li><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>E-mail</th>
                  <th></th>
                </tr>
              </thead>
              <tbody class="valign-middle">
                <tr>
                  <td>1</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@rjang</a>
                  </td>
                  <td>Robert Jang</td>
                  <td>rjang@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@mbortz</a>
                  </td>
                  <td>Michelle Bortz</td>
                  <td>mbortz@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@towens</a>
                  </td>
                  <td>Timothy Owens</td>
                  <td>towens@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/5.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@dsteiner</a>
                  </td>
                  <td>Denise Steiner</td>
                  <td>dsteiner@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/2.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@rjang</a>
                  </td>
                  <td>Robert Jang</td>
                  <td>rjang@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/3.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@mbortz</a>
                  </td>
                  <td>Michelle Bortz</td>
                  <td>mbortz@example.com</td>
                  <td></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>
                    <img src="<?php echo $assets_url; ?>dashboard/dist/demo/avatars/4.jpg" alt="" style="width:26px;height:26px;" class="border-round">&nbsp;&nbsp;<a href="#" title="">@towens</a>
                  </td>
                  <td>Timothy Owens</td>
                  <td>towens@example.com</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- / New users -->

      </div>
      <div class="col-md-5">

        <!-- Recent tasks -->

        <div class="panel panel-primary panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i>Recent tasks</span>
          </div>

          <div class="widget-tasks-item">
            <span class="label label-warning pull-right">High</span>
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A very important task</span>&nbsp;&nbsp;
              <span class="widget-tasks-timer">1 hour left</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <span class="label label-warning pull-right">High</span>
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" checked="">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A very important task</span>&nbsp;&nbsp;
              <span class="widget-tasks-timer">58 minutes left</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" checked="">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A regular task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A regular task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A regular task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <span class="label pull-right">Low</span>
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">A regular task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <span class="label pull-right">Low</span>
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">An unimportant task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <span class="label pull-right">Low</span>
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">An unimportant task</span>
            </label>
          </div>

          <div class="widget-tasks-item">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="widget-tasks-title">An unimportant task</span>
            </label>
          </div>
        </div>

        <!-- /Recent tasks -->

      </div>
    </div>
  </div>


  <footer class="px-footer px-footer-bottom p-t-0" id="px-demo-footer">
    <div class="box m-a-0 bg-transparent">
      <div class="box-cell col-md-3 p-t-3">
        <h5 class="m-t-0 m-b-1 font-size-13">About Us</h5>
        <a href="#">Who we are</a><br>
        <a href="#">Jobs</a><br>
        <a href="#">Newsletters</a><br>
      </div>
      <div class="box-cell col-md-3 p-t-3">
        <h5 class="m-t-0 m-b-1 font-size-13">Help</h5>
        <a href="#">Support Center</a><br>
        <a href="#">Terms of Use</a><br>
        <a href="#">Privacy Policy</a><br>
      </div>
      <div class="box-cell col-md-3 p-t-3">
        <h5 class="m-t-0 m-b-1 font-size-13">Products</h5>
        <a href="#">Popular</a><br>
        <a href="#">Most rated</a><br>
        <a href="#">Recent</a><br>
      </div>
      <div class="box-cell col-md-3 p-t-3 valign-middle">
        <a href="#" class="display-block m-b-1 text-nowrap"><i class="fa fa-twitter"></i>&nbsp;&nbsp;@pixeladmin</a>
        <a href="#" class="display-block m-b-1 text-nowrap"><i class="fa fa-facebook"></i>&nbsp;&nbsp;PixelAdmin</a>
        <a href="#" class="display-block text-nowrap"><i class="fa fa-envelope"></i>&nbsp;&nbsp;support@pixeladmin.com</a>
      </div>
    </div>

    <hr class="page-wide-block">

    <span class="text-muted">Copyright © 2016 PixelAdmin LLC. All rights reserved.</span>
  </footer>




  
