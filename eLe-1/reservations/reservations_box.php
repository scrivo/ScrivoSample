<div id="ele_reservation"> 
	<div class="ele_reservation_body">
		<div id="ele_wrapper">  
			<form>
				<div id="ele_form_wrapper">
					<h1 class="ele_header">maak een reservering</h1>
					<div class="ele_box_wrapper">
						<div class="ele_gray_box">
							<div id="ele_search_box">
								<div class="ele_box_row">
									<div class="ele_row_title">Naam</div>
									<div class="ele_row_value"><input id="resName" name="name"></div>
								</div>
								<div class="ele_box_row ele_date_row">
									<div class="ele_row_title">E-mail/tel</div>
									<div class="ele_row_value"><input id="resContact" name="contact"></div>
								</div>
								<div class="ele_box_row ele_date_row">
									<div class="ele_row_title">datum</div>
									<div class="ele_row_value">
										<input name="date" type="text" id="resDate" 
										value="<?php echo ReservationCalendar::getStartDay()->format("d-m-Y")?>" 
										readonly="readonly"
										onfocus="getInputDate(this,this.value,'jsCalendar');drawCalendar('jsCalendar');" 
										onchange="getInputDate(this,this.value,'jsCalendar');drawCalendar('jsCalendar');" 
									/><div class="jsCalendar" id="jsCalendar"></div>
									</div>
								</div>
								<div class="ele_box_row">
									<div class="ele_row_title">personen</div>
									<div class="ele_row_value">
										<select name="person" id="resPersons">
											<option value="1">1 persoon</option>
											<option selected value="2">2 personen</option>
											<option value="3">3 personen</option>
											<option value="4">4 personen</option>
											<option value="5">5 personen</option>
											<option value="6">6 personen</option>
											<option value="7">7 personen</option>
											<option value="8">8 personen</option>
											<option value="9">9 personen</option>
											<option value="10">10 personen</option>
										</select>
									</div>
								</div>
								<div class="ele_box_row">
									<div class="ele_row_title">tijd</div>
									<div id="divTime" class="ele_row_value">
										<select class="selectTime" id="resTime" name="time"><?php
											foreach(ReservationCalendar::getTimes() as $k=>$v) {
												echo "<option value=\"$k\">$v</option>";
											}
										?></select>
									</div>
								</div>
								<div id="ele_submit_wrapper">
									<img onclick="return makeReservation()" 
										class="submitbutton" border="0" 
										src="reservations/make-reservation-nl.png" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

