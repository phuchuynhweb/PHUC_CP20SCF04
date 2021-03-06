(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: PT (Portuguese; português)
 * Region: BR (Brazil)
 */
$.extend( $.validator.messages, {

	// Core
	required: "Este campo &eacute; requerido.",
	remote: "Por favor, corrija este campo.",
	email: "Por favor, forne&ccedil;a um endere&ccedil;o de email v&aacute;lido.",
	url: "Por favor, forne&ccedil;a uma URL v&aacute;lida.",
	date: "Por favor, forne&ccedil;a uma data v&aacute;lida.",
	dateISO: "Por favor, forne&ccedil;a uma data v&aacute;lida (ISO).",
	number: "Por favor, forne&ccedil;a um n&uacute;mero v&aacute;lido.",
	digits: "Por favor, forne&ccedil;a somente d&iacute;gitos.",
	creditcard: "Por favor, forne&ccedil;a um cart&atilde;o de cr&eacute;dito v&aacute;lido.",
	equalTo: "Por favor, forne&ccedil;a o mesmo valor novamente.",
	maxlength: $.validator.format( "Por favor, forne&ccedil;a n&atilde;o mais que {0} caracteres." ),
	minlength: $.validator.format( "Por favor, forne&ccedil;a ao menos {0} caracteres." ),
	rangelength: $.validator.format( "Por favor, forne&ccedil;a um valor entre {0} e {1} caracteres de comprimento." ),
	range: $.validator.format( "Por favor, forne&ccedil;a um valor entre {0} e {1}." ),
	max: $.validator.format( "Por favor, forne&ccedil;a um valor menor ou igual a {0}." ),
	min: $.validator.format( "Por favor, forne&ccedil;a um valor maior ou igual a {0}." ),
	step: $.validator.format( "Por favor, forne&ccedil;a um valor m&uacute;ltiplo de {0}." ),

	// Metodos Adicionais
	maxWords: $.validator.format( "Por favor, forne&ccedil;a com {0} palavras ou menos." ),
	minWords: $.validator.format( "Por favor, forne&ccedil;a pelo menos {0} palavras." ),
	rangeWords: $.validator.format( "Por favor, forne&ccedil;a entre {0} e {1} palavras." ),
	accept: "Por favor, forne&ccedil;a um tipo v&aacute;lido.",
	alphanumeric: "Por favor, forne&ccedil;a somente com letras, n&uacute;meros e sublinhados.",
	bankaccountNL: "Por favor, forne&ccedil;a com um n&uacute;mero de conta banc&aacute;ria v&aacute;lida.",
	bankorgiroaccountNL: "Por favor, forne&ccedil;a um banco v&aacute;lido ou n&uacute;mero de conta.",
	bic: "Por favor, forne&ccedil;a um c&oacute;digo BIC v&aacute;lido.",
	cifES: "Por favor, forne&ccedil;a um c&oacute;digo CIF v&aacute;lido.",
	creditcardtypes: "Por favor, forne&ccedil;a um n&uacute;mero de cart&atilde;o de cr&eacute;dito v&aacute;lido.",
	currency: "Por favor, forne&ccedil;a uma moeda v&aacute;lida.",
	dateFA: "Por favor, forne&ccedil;a uma data correta.",
	dateITA: "Por favor, forne&ccedil;a uma data correta.",
	dateNL: "Por favor, forne&ccedil;a uma data correta.",
	extension: "Por favor, forne&ccedil;a um valor com uma extens&atilde;o v&aacute;lida.",
	giroaccountNL: "Por favor, forne&ccedil;a um n&uacute;mero de conta corrente v&aacute;lido.",
	iban: "Por favor, forne&ccedil;a um c&oacute;digo IBAN v&aacute;lido.",
	integer: "Por favor, forne&ccedil;a um n&uacute;mero n&atilde;o decimal.",
	ipv4: "Por favor, forne&ccedil;a um IPv4 v&aacute;lido.",
	ipv6: "Por favor, forne&ccedil;a um IPv6 v&aacute;lido.",
	lettersonly: "Por favor, forne&ccedil;a apenas com letras.",
	letterswithbasicpunc: "Por favor, forne&ccedil;a apenas letras ou pontua&ccedil;ões.",
	mobileNL: "Por favor, fornece&ccedil;a um n&uacute;mero v&aacute;lido de telefone.",
	mobileUK: "Por favor, fornece&ccedil;a um n&uacute;mero v&aacute;lido de telefone.",
	nieES: "Por favor, forne&ccedil;a um NIE v&aacute;lido.",
	nifES: "Por favor, forne&ccedil;a um NIF v&aacute;lido.",
	nowhitespace: "Por favor, n&atilde;o utilize espa&ccedil;os em branco.",
	pattern: "O formato fornecido &eacute; inv&aacute;lido.",
	phoneNL: "Por favor, forne&ccedil;a um n&uacute;mero de telefone v&aacute;lido.",
	phoneUK: "Por favor, forne&ccedil;a um n&uacute;mero de telefone v&aacuthub.com-1ecc6299db9ec823\slog-2.1.1\src\lib.rsslog::Fuse Drain:    ��D     @�C       ��C ��@       ��C ��C ��C ��@        �C `�C ��@        ��C ��@       �@ could not create process snapshotcould not get first process data   \�D    s�D    <�D ��D        $�D    �D !   ��D    ��D    ��D    ��D ��D        Failed to kill process  ��D    ��D    |�D ��D        $�D    �      ��D     2�D    Successfully killed , pid   $�D    �      ��D     2�D    Found  running, pid , attempting to kill...Failed to get process file name: Failed to open process: $�D    [      ��D     2�D    Kill process if found: , could not get process file namecould not get convert file name to str  <�D    Q�D    h�D    �D ��D        ��D     �D    ��D ��D        attempting to kill any running Code.exe processes   ��D    ��D    ��D ��D        ��D     ��D    x�D ��D        $�D    �      ��D     2�D     is running, wait a bit $�D    �      ��D     2�D    Gave up waiting for  to exit$�D    �      ��D     2�D     is not running $�D    �      ��D     2�D    Checking for running  processes... (attempt )   ��D $   ��D    K  	   Tried to shrink to a larger capacityliballoc\raw_vec.rs ��@       `�B ��@ ��B  �B ��B ��C       ��B 0�@ 0�B @�B ��B ��@       ��B ��@ ��B P�B  �B ��@       �_A PbA ��C ]A �XA ��@        �B ��@ ��B ��B ��B ��@       @�B ��@ ��B ��B P�B ��@       ��B ��@ ��B p�B `�B ��@        p�B ��@ ��B 0�B ��B cannot access a TLS value during or after it is destroyedattempt to join into collection with len > usize::MAX  L�D    �      L�D    �   !   libstd\sync\mpsc\oneshot.rsassertion failed: (*self.data.get()).is_none()   L�D    k      L�D    |      upgrading again L�D    �      L�D         ��D     �  :   libstd\collections\hash\table.rs   L�D    �  	   stream did