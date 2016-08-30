<script type = "text/javascript" >

function crackPassword(pass_numeric) {
    var char_list = 'abcdefghijklmnopqrstuvwxyz',
        result = '',
        offset;

    for(num = pass_numeric ; num > 0 ; num = (num - offset) / 17) {
    	offset = num % 17;
        result = char_list.charAt(offset - 1) + result;
    }
    return result;
}

console.log(crackPassword(248410397744610));

</script>
