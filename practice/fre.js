function caseconvert(arr){
    converted =""
    for(let i =0;i<arr.length;i++){
        let char=arr[i]
        if(char===char.toUpperCase()){
            converted+=char.toLowerCase()
        }
        else if(char===char.toLowerCase()){
            converted+=char.toUpperCase()

        }
        else{
            converted+=char
        }
        
        }
        return converted
    }
    console.log(caseconvert("The Quick Brown Fox"))

