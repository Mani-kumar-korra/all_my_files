function removedup(arr){
    uniarr =[]
    for(let i =0 ;i<arr.length;i++){
        let words= arr[i]
        let isDup =false


        for(let j =0 ;j<uniarr.length;j++){
            if(words.toLowerCase()===uniarr[j].toLowerCase()){
                isDup = true;
                break;
            }

        }
        if(isDup ==false){
            uniarr.push(words)
        }
    }
    return uniarr
}

let arr = ['bharath','Bharath','mani','pooja','re','Mani'];

console.log(removedup(arr))