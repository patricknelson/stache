<?
/**
 * Bastardized version of "Mustache" without any of the feature richness. Just allows you to dynamically render/parse 
 * a basic string using only the typical {{name}} format. No frills or thrills.
 */
class Stache {

	// Values used when rendering a template string.
	protected $values = array();


	/**
	 * Set values for use when rendering. Can provide associative array of values or simple name/value pair using second
	 * parameter.
	 *
	 * @param	array|string	$valuesOrKey	Associative array of name/value pairs.
	 * @param	mixed			$value			Value to use if first parameter is a name.
	 */
	public function assign($valuesOrKey, $value = null) {
		if (is_array($valuesOrKey)) {
			// Pass through to current assignment method to allow filtering/de-duplication of name.
			foreach($valuesOrKey as $name => $curValue) {
				$this->assign($name, $curValue);
			}
		} else {
			// Filter the name prior to assignment.
			$name = trim(preg_replace("#[^-a-z_0-9]#i", "", $valuesOrKey), "-");
			if (empty($name)) return;

			// Perform value assignment now.
			$this->values[$name] = $value;
		}
	}


	/**
	 * @return array
	 */
	public function getValues() {
		return $this->values;
	}


	/**
	 * @param	string	$templateString
	 * @param	array	$assignValues
	 * @return	string
	 */
	public function render($templateString, $assignValues = array()) {
		// Assign any provided values now.
		$this->assign($assignValues);

		// Get all assigned values now and setup initial rendered string.
		$values = $this->getValues();
		$rendered = $templateString;

		// Tokenize the template string (setup custom placeholders) to refer to our assigned names to prevent any sort
		// of accidental recursion, in case there are values that have matching Stache tokens (e.g. {{name}}).
		$tokens = array();
		foreach($values as $name => $value) {
			$token = $this->genToken();
			$tokens[$name] = $token;
			$rendered = str_replace("{{{$name}}}", $token, $rendered);
		}

		// Replace tokens with values.
		foreach($tokens as $name => $token) {
			$value = (string) $values[$name];
			$rendered = str_replace($token, $value, $rendered);
		}

		return $rendered;
	}


	/**
	 * Generates a completely randomized 10 character token string.
	 *
	 * @return string
	 */
	public function genToken() {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$token = "";
		for($i = 10; $i--; ) {
			$token .= substr($chars, (mt_rand() % (strlen($chars))), 1);
		}

		return $token;
	}
}
