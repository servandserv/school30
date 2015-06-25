/**
 * 
 * Компонент для отображения списка дайджестов
 *
 */
;(function (w,h) {

    var ns = "School.View.Component.DigestsList";

    h.Locator(ns, function() {
        
        var selected;
        var views = [];
    
        views.push(h.XMLView.extend({
            template: ROOT+"stylesheets/School/component/DigestsList.xsl",
            bind: function(el,args) {
                h.Mediator.subscribe("DigestsList:ready", function( ds ) {
                    //console.log(document.getElementById("DigestsListCount"),ds.getDigest().length);
                    document.getElementById("DigestsListCount").innerHTML = ds.getDigest().length;
                })
            }
        }));
        var adaptor = h.Port.Adaptor.HTTP.extend({
            fetch: function (request) {
                var digests = h.Locator("School.Port.Adaptor.Data.School.Digests");
                this.get({
                    url: ROOT+"api/digests",
                    accept: "application/xml",
                    callback: function (http) {
                        for(var i=0;i<views.length;i++) {
                            console.log(document.getElementById("digests"));
                            views[i].render(http.responseXML);
                        }
                        digests.XML = http.responseXML;
                        digests.fromXmlStr(http.responseText, function(ds) {
                            Happymeal.Mediator.publish('DigestsList:ready',ds);
                        });
                    }
                });
            }
        });
    
        var render =  function () {
            if(arguments.length !== views.length) {
                h.Mediator.publish("ErrorOccured",{ msg:"Число переданных элементов для отрисовки компонента не соответствует числу представлений" });
                return;
            }
            for(var i=0;i<views.length;i++) {
                views[i].elementId = arguments[i];
            }
            adaptor.fetch(this.request);
        }
    
        function DigestsList (request) {
            this.request = request || {};
            selected = this.request.selected;
        }
    
        DigestsList.prototype.render = render;
        return DigestsList;
    });
}(window,Happymeal));