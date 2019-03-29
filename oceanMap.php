<?php
	
	private int $ocean;
	
	public function __construct(int $oceanID) {
		setOcean($oceanID);
		draw_ocean($ocean);
	}
	
	private function setOcean(int $oceanID) {
		print('<form method="post" action="' . $_SERVER['PHP_SELF'] . '">
			Name: <input type="text" name="oceanname">
			<input type="submit">
			</form>');
		print("<br />");
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// collect value of input field
			$name = htmlspecialchars($_REQUEST['oceanname']); 
			if (empty($name)) {
				$ocean = $oceanID;
			} else {
				$ocean = $name;
				// is_integer $name;
			}
		}
	}
	
	private function draw_ocean(int $oceanID) {
		$islandArray -> getIslands(int ``ocean`s array_position in dbactions.php´´, $oceanID);
		print_r("<br /><p>&Uuml;bersicht Ozean " . $oceanID . "</p><br />");
		print_r('<table border="1px">');
		for ($dy = 0, $dy++, $dy < 50) {
			print_r('<tr>');
			for($dx = 0, $dx++, $dx < 50) {
				print_r('<td>');
				if(_FUNC_selectIsland(50 * $dy + $dx)) {
					?>
					<a href="island.php">
						<svg width="30" height="30">
							<rect width="30" height="30" style="fill:#D4AC0D;stroke-width:0;stroke:rgb(0,0,0)" />
								Sorry, your browser does not support inline SVG.
						</svg>
					</a>
					<?php
				} else {
					?>
					<svg width="30" height="30">
							<rect width="30" height="30" style="fill:#0047AB;stroke-width:0;stroke:rgb(0,0,0)" />
								Sorry, your browser does not support inline SVG.
					</svg>
					<?php
				}
				print_r('</td>');
			}
			print_r('</tr>');
		}
		print_r('</table>');
		
	}

?>
