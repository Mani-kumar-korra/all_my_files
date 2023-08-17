function formate(num){
    if(typeof num !=="number"){
        return "invalid input"
    }
    var suffix ="";

    if(num===11||num||12||num==13){
        suffix ="th"
    }
    else {
        let lastnum=num%10;
        switch(lastnum){
            case 1 :
                suffix ="st"
                break;
            case 2 :
                suffix="nd"
                break;
            case 3:
                suffix ="rd"
                break;
            default :
                suffix = "th"
                break;
        }
    }
    return num+suffix
}
console.log(formate(6))