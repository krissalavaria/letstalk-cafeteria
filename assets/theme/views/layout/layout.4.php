  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
    <div class="app-header navbar-md white box-shadow">
      <div ui-include="'../pos/assets/theme/views/blocks/header.4.html'"></div>
    </div>
    <div ui-view class="app-body" ng-class="{'container': app.setting.container}" id="view"></div>
    <div class="dark dk pos-rlt" ng-class="{'hide': $state.current.data.hideFooter}">
      <div class="p-md" ng-class="{'container': app.setting.container}" >
        <div ui-include="'../pos/assets/theme/views/blocks/footer.1.html'"></div>
      </div>
    </div>
  </div>
  <!-- / -->

  <!-- theme switcher -->
  <div id="switcher">
    <div ui-include="'../pos/assets/theme/views/blocks/switcher.html'"></div>
  </div>
  <!-- / -->
