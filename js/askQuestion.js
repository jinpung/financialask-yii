const QUESTION_INPUT = ".questionInput";
const BUTTON_SUBMIT = ".submitBtn";
const MIN_LENGTH = 50;

function changedInput(){
  var len = $(QUESTION_INPUT).val().length;
  if(len >= MIN_LENGTH) $(BUTTON_SUBMIT).removeAttr('disabled');
  else $(BUTTON_SUBMIT).attr('disabled', 'disabled');

}
function onLoad(){
  $(QUESTION_INPUT).keyup(changedInput);
  changedInput();

  var inputOptions = {
    'maxCharacterSize':255,
    'originalStyle':'textCounter',
    'warningStyle':'textCounterWarning',
    'warningNumber':40,
    'displayFormat':'#input/#max'
  };
  $(QUESTION_INPUT).textareaCount(inputOptions);

}
$(document).ready(onLoad);
