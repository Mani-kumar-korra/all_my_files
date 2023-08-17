function camel(str){
    let str1 = str.split(" ")
    if(str1[1][0]===str1[1][0].toUpperCase())
    return str1.join('');
    else{
       return str1[0]+str1[1][0].toUpperCase()+str1[1].slice(1)
        
    }


}


console.log(camel("mani kumar"))