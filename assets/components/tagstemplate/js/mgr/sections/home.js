tagsTemplate.page.Home = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'tagstemplate-panel-home'
			,renderTo: 'tagstemplate-panel-home-div'
		}]
	}); 
	tagsTemplate.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(tagsTemplate.page.Home,MODx.Component);
Ext.reg('tagstemplate-page-home',tagsTemplate.page.Home);