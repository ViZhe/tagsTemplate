var tagsTemplate = function(config) {
	config = config || {};
	tagsTemplate.superclass.constructor.call(this,config);
};
Ext.extend(tagsTemplate,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('tagstemplate',tagsTemplate);

tagsTemplate = new tagsTemplate();