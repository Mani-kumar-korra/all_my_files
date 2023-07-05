function human(num){
    let suffix =""
    if((num===11||num==12||num==13)){
        suffix ="th"
    }else {
        let remain= num%10;
        switch(remain){
            case 1:
                suffix="st"
                break;
            case 2:
                suffix="ed"
                break;
            case 3:
                suffix="rd"
                break;
            default:
                suffix="th"
        }
    
    }
    return num+suffix
}
    console.log(human(3))