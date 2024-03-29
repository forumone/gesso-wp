/**
 * Whether a string is a printable character
 *
 * @param {string} str - The string to test.
 * @return {boolean} A true or false value.
 */
function isPrintableCharacter(str) {
	return str.length === 1 && str.match(/\S/);
}

export default isPrintableCharacter;
