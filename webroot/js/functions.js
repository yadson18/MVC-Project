function removeSpaces(str) {
    return str.replace(/^\s+|\s+$/g,"");
}

function cepFormat(cep){
  if(cep.length === 8){
    return cep.substring(0, 5) + "-" + cep.substring(5, 8);
  }
  return cep;
}

function capitalize(value){
  var lower = value.toLowerCase();
  return lower.charAt(0).toUpperCase() + lower.substring(1, lower.length);
}

function cnpjFormat(cnpj){
  if(cnpj.length === 14){
    return cnpj.substring(0, 2) + "." + 
           cnpj.substring(2, 5) + "." + 
           cnpj.substring(5, 8) + "/" + 
           cnpj.substring(8, 12) + "-" + 
           cnpj.substring(12, 14);
  }
  return cnpj;
}

function getJson(str) {
    try{
        var json = JSON.parse(str);
    	
    	return json;
    }
    catch(e){
        return false;
    }
}