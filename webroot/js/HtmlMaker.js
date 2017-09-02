var HtmlMaker = function(){
	return {
		setTag: function(tagName, attributes){
			var element = document.createElement(tagName);

			if(typeof attributes === "object" && !$.isEmptyObject(attributes)){
				Object.keys(attributes).map(function(attributeName){
					if(attributeName === "text"){
						element.innerText = attributes[attributeName];
					}
					else if(attributeName === "class"){
						attributes[attributeName].split(" ").map(function(className){
							element.classList.add(className);
						});
					}
					else if(attributeName === "id"){
						element.setAttribute("id", attributes[attributeName]);
					}
					else if(attributeName === "html"){
						if(Array.isArray(attributes[attributeName])){
							attributes[attributeName].map(function(value){
								element.appendChild(value);
							});
						}
						else{
							element.appendChild(attributes[attributeName]);
						}
					}
					else{
						element.setAttribute(attributeName, attributes[attributeName]);
					}
				});
			}
			return element;
		},
		div: function(attributes){
			return this.setTag("div", attributes);
		},
		p: function(attributes){
			return this.setTag("p", attributes)
		},
		tr: function(attributes){
			return this.setTag("tr", attributes);
		},
		th: function(attributes){
			return this.setTag("th", attributes);
		},
		td: function(attributes){
			return this.setTag("td", attributes);
		},
		button: function(attributes){
			return this.setTag("button", attributes);
		},
		i: function(attributes){
			return this.setTag("i", attributes);
		},
		span: function(attributes){
			return this.setTag("span", attributes);
		},
		option: function(attributes){
			return this.setTag("option", attributes);
		}
	};
}