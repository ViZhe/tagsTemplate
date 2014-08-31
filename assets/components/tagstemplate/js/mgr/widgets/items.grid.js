tagsTemplate.grid.Items = function(config) {
	config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'tagstemplate-grid-items'
		,url: tagsTemplate.config.connector_url
		,baseParams: {
			action: 'mgr/item/getlist'
		}
		,fields: ['id','name','description']
		,autoHeight: true
		,paging: true
		,remoteSort: true
        ,sm: this.sm
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 70}
			,{header: _('name'),dataIndex: 'name',width: 200}
			,{header: _('description'),dataIndex: 'description',width: 250}
		]
		,tbar: [{
			text: _('tagstemplate_item_create')
			,handler: this.createItem
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateItem(grid, e, row);
			}
		}
	});
	tagsTemplate.grid.Items.superclass.constructor.call(this,config);
};
Ext.extend(tagsTemplate.grid.Items,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
        var cs = this.getSelectedAsList();
        var m = [];
        if (cs.split(',').length > 1) {
            m.push({
    			text: _('tagstemplate_items_remove')
    			,handler: this.removeSelected
    		});
        } else {
    		m.push({
    			text: _('tagstemplate_item_update')
    			,handler: this.updateItem
    		});
    		m.push('-');
    		m.push({
    			text: _('tagstemplate_item_remove')
    			,handler: this.removeItem
    		});
        }
		this.addContextMenuItem(m);
	}
	
	,createItem: function(btn,e) {
		if (!this.windows.createItem) {
			this.windows.createItem = MODx.load({
				xtype: 'tagstemplate-window-item-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createItem.fp.getForm().reset();
		this.windows.createItem.show(e.target);
	}

	,updateItem: function(btn,e,row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: tagsTemplate.config.connector_url
			,params: {
				action: 'mgr/item/get'
				,id: id
			}
			,listeners: {
				success: {fn:function(r) {
					if (!this.windows.updateItem) {
						this.windows.updateItem = MODx.load({
							xtype: 'tagstemplate-window-item-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateItem.fp.getForm().reset();
					this.windows.updateItem.fp.getForm().setValues(r.object);
					this.windows.updateItem.show(e.target);
				},scope:this}
			}
		});
	}

	,removeItem: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('tagstemplate_item_remove')
			,text: _('tagstemplate_item_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/item/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

    ,getSelectedAsList: function() {
        var sels = this.getSelectionModel().getSelections();
        if (sels.length <= 0) return false;

        var cs = '';
        for (var i=0;i<sels.length;i++) {
            cs += ','+sels[i].data.id;
        }
        cs = cs.substr(1);
        return cs;
    }

    ,removeSelected: function(act,btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.msg.confirm({
			title: _('tagstemplate_items_remove')
			,text: _('tagstemplate_items_remove_confirm')
			,url: this.config.url
			,params: {
                action: 'mgr/items/remove'
                ,items: cs
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                       var t = Ext.getCmp('modx-resource-tree');
                       if (t) { t.refresh(); }
                },scope:this}
            }
        });
        return true;
    }
});
Ext.reg('tagstemplate-grid-items',tagsTemplate.grid.Items);




tagsTemplate.window.CreateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('tagstemplate_item_create')
		,id: this.ident
		,height: 200
		,width: 475
		,url: tagsTemplate.config.connector_url
		,action: 'mgr/item/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'tagstemplate-'+this.ident+'-name',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'tagstemplate-'+this.ident+'-description',height: 150,anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	tagsTemplate.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(tagsTemplate.window.CreateItem,MODx.Window);
Ext.reg('tagstemplate-window-item-create',tagsTemplate.window.CreateItem);


tagsTemplate.window.UpdateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('tagstemplate_item_update')
		,id: this.ident
		,height: 200
		,width: 475
		,url: tagsTemplate.config.connector_url
		,action: 'mgr/item/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'tagstemplate-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'tagstemplate-'+this.ident+'-name',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('description'),name: 'description',id: 'tagstemplate-'+this.ident+'-description',height: 150,anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	tagsTemplate.window.UpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(tagsTemplate.window.UpdateItem,MODx.Window);
Ext.reg('tagstemplate-window-item-update',tagsTemplate.window.UpdateItem);