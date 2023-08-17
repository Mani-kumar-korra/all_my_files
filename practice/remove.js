function removeval(str,val){
    for(let i in str){
        if (str[i]===val){
        str.splice(i,1);
        console.log(str)
    }
}
}
str=[1,2,3,4,5]
removeval(str,2)