window.Event = new Vue();

Vue.component('block-list', {
	template:`
		<div id="container">
			<div class="button">
				<button class="add_new_line" v-on:click="addVerticalLine">Add New Row</button>
			</div>
		<div v-for="(vertical_row, index) in rows" class="row_container">						
			<div class="button">
				<button class="add_new_row" v-on:click="addHorizontalRow(index)">Add New Block</button>
			</div>
			<div v-for="(horizontal_row, index) in vertical_row.horizontal_rows" class="horizontal_row_container">
				<div class="button">
					<button class="add_block" v-on:click="addItem(vertical_row.vertical_index, index)">Add Item</button>
				</div>				
				<block-item v-for="(block, index) in horizontal_row.blocks"
				v-bind:this_item_index="index"
				v-bind:this_vertical_index="block.vertical_row_index"
				v-bind:this_horizontal_index="block.horizontal_row_index"
				v-bind:this_width="block.width"
				v-bind:this_height="block.height"
				v-bind:this_margin_left="block.margin_left"
				v-bind:this_margin_top="block.margin_top"
				>
				</block-item>
			</div>
		</div>
	`,


data() {
	return {
		rows: [{
			vertical_index:0,
			horizontal_rows: [
				{
				blocks: [
							{
								vertical_row_index: 0,
								horizontal_row_index: 0,
								height: 200,
								width: 200,
								margin_top : 90,
								margin_left : 90,
							},
							{
								vertical_row_index: 0,
								horizontal_row_index: 0,
								height: 200,
								width: 400,
								margin_top : 90,
								margin_left : 180,
							}
						]
					},
					{
						blocks: [
						{
							vertical_row_index: 0,
							horizontal_row_index: 1,
							height: 200,
							width: 200,
							margin_top : 90,
							margin_left : 90,
						}
					]
					}
				]
			},
			{
				vertical_index:1,
				horizontal_rows: [{
					blocks: [
						{
							vertical_row_index: 1,
							horizontal_row_index: 0,
							height: 200,
							width: 200,
							margin_top : 90,
							margin_left : 90,
						}
					]					
				}]
			}]
	}
},
created() {
		Event.$on('wide', function(vertical_row_index, horizontal_row_index, item_index)  {			
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].width = this.newStyle('wide', vertical_row_index, horizontal_row_index, item_index);
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_left = this.newArrow('wide', vertical_row_index, horizontal_row_index, item_index);
		}.bind(this))
		
		Event.$on('narrow', function(vertical_row_index, horizontal_row_index, item_index)  {			
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].width = this.newStyle('narrow', vertical_row_index, horizontal_row_index, item_index);
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_left = this.newArrow('narrow', vertical_row_index, horizontal_row_index, item_index);
		}.bind(this))
		
		Event.$on('high', function(vertical_row_index, horizontal_row_index, item_index)  {			
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].height = this.newStyle('high', vertical_row_index, horizontal_row_index, item_index);
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_top = this.newArrow('high', vertical_row_index, horizontal_row_index, item_index);
		}.bind(this))

		Event.$on('low', function(vertical_row_index, horizontal_row_index, item_index)  {			
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].height = this.newStyle('low', vertical_row_index, horizontal_row_index, item_index);
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_top = this.newArrow('low', vertical_row_index, horizontal_row_index, item_index);
		}.bind(this))

		Event.$on('closeBlock', function(vertical_row_index, horizontal_row_index, item_index)  {	
			//remove item
			this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks.splice(item_index, 1);

			if(this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks.length > item_index+1) {
				for (let i = item_index; i < this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks.length; i++) {
				  this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[i].this_item_index -= 1;
				}
			}

			//remove horizontal row
			if (this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks.length === 0) {
				this.rows[vertical_row_index].horizontal_rows.splice(horizontal_row_index, 1);	

				if(this.rows[vertical_row_index].horizontal_rows.length > horizontal_row_index) {

					for (let j = horizontal_row_index; j < this.rows[vertical_row_index].horizontal_rows.length; j++) {
						
					  for (let i = 0; i < this.rows[vertical_row_index].horizontal_rows[j].blocks.length; i++) {
						  this.rows[vertical_row_index].horizontal_rows[j].blocks[i].horizontal_row_index -= 1;
						}

					}
				}
			}

			//remove vertical row
			if (this.rows[vertical_row_index].horizontal_rows.length === 0) {
				this.rows.splice(vertical_row_index, 1);	
				this.rows[vertical_row_index].vertical_index -= 1;

				if(this.rows.length > vertical_row_index) {
					for (let k = vertical_row_index; k < this.rows.length; k++) {						
						for (let j = horizontal_row_index; j < this.rows[k].horizontal_rows.length; j++) {
							for (let i = 0; i < this.rows[k].horizontal_rows[j].blocks.length; i++) {
							  this.rows[k].horizontal_rows[j].blocks[i].vertical_row_index -= 1;							  
							}
						}
					}
				}
			}
			
		}.bind(this))
	},
	 methods: {
	 		addVerticalLine() {
	 			this.rows.push({
	 				vertical_index:this.rows.length,
					horizontal_rows: [
						{
						blocks: [
							{
								vertical_row_index: this.rows.length,
								horizontal_row_index: 0,
								height: 200,
								width: 200,
								margin_top : 90,
								margin_left : 90,
							}
						]
					}]
	 			})
	 		},
	 		addHorizontalRow(vertical_row) {
	 			this.rows[vertical_row].horizontal_rows.push({
						blocks: [
							{
								vertical_row_index: vertical_row,
								horizontal_row_index: this.rows[vertical_row].horizontal_rows.length,
								height: 200,
								width: 200,
								margin_top : 90,
								margin_left : 90,
							}
						]
					
	 			})
	 		},
	 		addItem(vertical_row, horizontal_row) {
	 			var total_width = 0;
					for (const block of this.rows[vertical_row].horizontal_rows[horizontal_row].blocks) { 
						var width = block.width;
						total_width = parseInt(width) + parseInt(total_width);
					}

					if(parseInt(total_width) === 1200) {						
						return;
					} else {
						this.rows[vertical_row].horizontal_rows[horizontal_row].blocks.push({
							vertical_row_index: vertical_row,
							horizontal_row_index: horizontal_row,
							height: 200,
							width: 200,
							margin_top : 90,
							margin_left : 90,
			 			});
					}	 			
	 		},
			newStyle: function(method, vertical_row_index, horizontal_row_index, item_index) {
				if (method === 'wide') {
					var total_width = 0;
					for (const block of this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks) { 
						var width = block.width;
						total_width = parseInt(width) + parseInt(total_width);
					}

					var old_width = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].width;

					if(parseInt(total_width) === 1200) {						
						return old_width;
					}
					
					var new_width = parseInt(old_width) + 200;
					return new_width;
				}			
				if (method === 'narrow') {
					var old_width = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].width;	

					if(parseInt(old_width) === 200) {
						return;
					}

					var new_width = parseInt(old_width) - 200;
					return new_width;
				}	
				if (method === 'high') {
					var old_height = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].height;
					
					if(parseInt(old_height) === 800) {						
						return old_height;
					}

					var new_height = parseInt(old_height) + 200;
					return new_height;
				}		
				if (method === 'low') {
					var old_height = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].height;

					if(parseInt(old_height) === 200) {
						return old_height;
					}

					var new_height = parseInt(old_height) - 200;
					return new_height;
				}	
			},
			newArrow: function(method, vertical_row_index, horizontal_row_index, item_index) {
				if (method === 'wide') {
					var old_margin_left = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_left;

					var total_width = 0;
					for (const block of this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks) { 
						var width = block.width;
						total_width = parseInt(width) + parseInt(total_width);
					}

					if(parseInt(total_width) === 1200) {						
						return old_margin_left;
					}

					var new_margin_left = parseInt(old_margin_left) + 90;
					return new_margin_left;
				}
				if (method === 'narrow') {
					var old_margin_left = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_left;

					if(parseInt(old_margin_left) === 90) {
						return old_margin_left;
					}

					var new_margin_left = parseInt(old_margin_left) - 90;
					return new_margin_left;
				}
				if (method === 'high') {
					var old_margin_top = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_top;
					
					if(parseInt(old_margin_top) === 360) {						
						return old_margin_top;
					}

					var new_margin_top = parseInt(old_margin_top) + 90;
					return new_margin_top;
				}
				if (method === 'low') {
					var old_margin_top = this.rows[vertical_row_index].horizontal_rows[horizontal_row_index].blocks[item_index].margin_top;

					if(parseInt(old_margin_top) === 90) {
						return old_margin_top;
					}

					var new_margin_top = parseInt(old_margin_top) - 90;
					return new_margin_top;
				}
			},
	},

});

Vue.component('block-item', {
	template: `
		<div class="block_container">	
			<a href="#" class="close_link" v-on:click="closeBlock(this_vertical_index, this_horizontal_index, this_item_index)"><i class="fa-solid fa-xmark"></i></a>
			<a href="#" v-on:click="changeStyle('low', this_vertical_index, this_horizontal_index, this_item_index)"><div class="top_contract" :style="computed_width"><i class="fa-solid fa-caret-up" :style="computed_margin_left"></i></div></a>	
			<a href="#" v-on:click="changeStyle('narrow', this_vertical_index, this_horizontal_index, this_item_index)"><div class="left_contract" :style="computed_height"><i class="fa-solid fa-caret-left" :style="computed_margin_top"></i></div></a>	
			<div class="block" :style="computed_style"></div>
			<a href="#" v-on:click="changeStyle('wide', this_vertical_index, this_horizontal_index, this_item_index)"><div class="right_expand" :style="computed_height"><i class="fa-solid fa-caret-right" :style="computed_margin_top"></i></div></a>
			<a href="#" v-on:click="changeStyle('high', this_vertical_index, this_horizontal_index, this_item_index)"><div class="bottom_expand" :style="computed_width"><i class="fa-solid fa-caret-down" :style="computed_margin_left"></i></div></a>				
		</div>
	`,
	props: {
	    this_height: {
	      type: Number,
	      default: 200,
	      required: true,
	    },
	    this_width: {
	      type: Number,
	      default: 200,
	      required: true,
	    },
	    this_vertical_index: {
	    	type: Number,
	    	default: 0,
	    	required: true,
	    },
	    this_horizontal_index: {
	    	type: Number,
	    	default: 0,
	    	required: true,
	    },
	    this_item_index: {
	    	type: Number,
	    	default: 0,
	    	required: true,
	    },
	    this_margin_left: {
	    	type: Number,
	      	default: 90,
	      	required: true,
	    },
	    this_margin_top: {
	    	type: Number,
	      	default: 90,
	      	required: true,
	    }
  },
  computed: {
  	computed_style() {
  		return 'width:' + this.this_width + 'px;height:' + this.this_height + 'px;';  		
  	},
  	computed_width() {
		return 'width:' + this.this_width + 'px;';
  	},
  	computed_height() {
  		return 'height:' + this.this_height + 'px;';
  	},
  	computed_margin_left() {
  		return 'margin-left:' + this.this_margin_left + 'px;';
  	},
  	computed_margin_top() {
  		return 'margin-top:' + this.this_margin_top + 'px;';
  	}
  },
 
	methods: {
	changeStyle: function(method, vertical_index, horizontal_index, item_index) {
		Event.$emit(method, vertical_index, horizontal_index, item_index);
	},
	closeBlock: function(vertical_index, horizontal_index, item_index) {
		Event.$emit('closeBlock', vertical_index, horizontal_index, item_index);
	},
},

});

var data = {
	message: 'Magento Ultimate Home Page',	
};

Vue.config.devtools = true;

new Vue({
	el: '#app',
	data: data,
});

