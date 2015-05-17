var angular = require('angular');

// Load AppBuilder module
require('./app');

angular.module('KezacoEditor', ['AppBuilder'])
  .config(['$provide', function($provide) {

    $provide.decorator('Apps', [
      '$delegate', '$q', '$http', 'Resources',
      function(Apps, $q, $http, Resources) {

        Apps.fetchList = function() {
          return $http.get('/api/apps')
            .then(function(res) {
              if(angular.isArray(res.data)) {
                return res.data.map(function(appData) {
                  var app = Apps.App.fromManifest(appData.manifest);
                  app.meta.id =  appData.id;
                  return app;
                });
              } else {
                return [];
              }
            })
          ;
        };

        Apps.save = function(app) {
          app.resources = Resources.toJSON();
          var isNew = !('id' in app.meta);
          return $http[isNew ? 'post' : 'put'](
            isNew ? '/api/apps' : ('/api/apps/'+app.meta.id),
            {
              name: app.name,
              manifest: app.toManifest()
            }
          );
        };

        return Apps;

      }
    ]);

  }])
;
