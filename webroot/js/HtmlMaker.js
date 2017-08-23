class HtmlMaker{
	static setTag(tagName, attributes){
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
	}

	static div(attributes){
		return HtmlMaker.setTag("div", attributes);
	}

	static tr(attributes){
		return HtmlMaker.setTag("tr", attributes);
	}

	static th(attributes){
		return HtmlMaker.setTag("th", attributes);
	}

	static td(attributes){
		return HtmlMaker.setTag("td", attributes);
	}
}