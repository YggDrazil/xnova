<!-- INCLUDE fleet_javascript.tpl -->

<table width="519">
  <tr class="c_c">
    <th>{L_ov_time}</th>
    <th>{L_ov_fleet}</th>
    <th>{L_ov_destination}</th>
    <th>{L_ov_source}</th>
    <th>{L_ov_mission}</th>
  </tr>

  <!-- BEGIN fleets -->
  <!-- IF fleets.NUMBER -->
    <!-- IF fleets.S_FIRST_ROW && $OVERVIEW -->
      <!-- IF fleets.OV_THIS_PLANET -->
        <tr><th colspan="5" class="c">{L_ov_flying_fleets} {PLANET_NAME} [{PLANET_GALAXY}:{PLANET_SYSTEM}:{PLANET_PLANET}]</th></tr>
      <!-- ENDIF -->
      <!-- DEFINE $THIS_PLANET = 1 -->
    <!-- ENDIF -->

    <!-- IF $THIS_PLANET == 1 && fleets.OV_THIS_PLANET != 1 -->
      <tr><th colspan="5" class="c">{L_ov_flying_fleets} {L_ov_other_planets}</th></tr>
      <!-- DEFINE $THIS_PLANET = 2 -->
    <!-- ENDIF -->
    
    <!-- IF fleets.OV_LABEL == 0 -->
      <!-- DEFINE $OV_FLEET_ACTION = 'flight' -->
    <!-- ELSEIF fleets.OV_LABEL == 1 -->
      <!-- DEFINE $OV_FLEET_ACTION = 'holding' -->
    <!-- ELSEIF fleets.OV_LABEL == 2 -->
      <!-- DEFINE $OV_FLEET_ACTION = 'return' -->
    <!-- ENDIF -->

    <!-- IF USER_ID == fleets.OWNER -->
      <!-- DEFINE $OV_FLEET_PREFIX = 'own' -->
    <!-- ELSE -->
      <!-- DEFINE $OV_FLEET_PREFIX = '' -->
    <!-- ENDIF -->

    <!-- IF fleets.MISSION == 1 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'attack' -->
    <!-- ELSEIF fleets.MISSION ==  2 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'federation' -->
    <!-- ELSEIF fleets.MISSION ==  3 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'transport' -->
    <!-- ELSEIF fleets.MISSION ==  4 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'deploy' -->
    <!-- ELSEIF fleets.MISSION ==  5 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'hold' -->
    <!-- ELSEIF fleets.MISSION ==  6 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'espionage' -->
    <!-- ELSEIF fleets.MISSION ==  7 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'colony' -->
    <!-- ELSEIF fleets.MISSION ==  8 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'harvest' -->
    <!-- ELSEIF fleets.MISSION ==  9 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'destroy' -->
    <!-- ELSEIF fleets.MISSION == 10 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'missile' -->
    <!-- ELSEIF fleets.MISSION == 15 -->
      <!-- DEFINE $OV_FLEET_STYLE = 'expedition' -->
    <!-- ENDIF -->

    <tr class="{$OV_FLEET_ACTION} {$OV_FLEET_PREFIX}{$OV_FLEET_STYLE}">
      <th width=70>
        <div id="ov_fleer_timer_{$OV_FLEET_ACTION}{fleets.ID}" class="z">00:00:00</div>
        {fleets.OV_TIME_TEXT}
      </th>
      <th style="cursor: pointer;" onmouseover='fleet_dialog_show(this, {fleets.ID})' onmouseout='popup_hide()'>
        {fleets.AMOUNT}
      </th>
      <!-- IF fleets.OV_LABEL == 0 || fleets.OV_LABEL == 1  || fleets.OV_LABEL == 3 -->
        <th>
          {fleets.END_NAME}<br>
          {fleets.END_URL} {fleets.END_TYPE_TEXT_SH}
        </th>
        <th>
          {fleets.START_NAME}<br>
          {fleets.START_URL} {fleets.START_TYPE_TEXT_SH}
        </th>
      <!-- ELSEIF fleets.OV_LABEL == 2 -->
        <th>
          {fleets.START_NAME}<br>
          {fleets.START_URL} {fleets.START_TYPE_TEXT_SH}
        </th>
        <th>
          {fleets.END_NAME}<br>
          {fleets.END_URL} {fleets.END_TYPE_TEXT_SH}
        </th>
      <!-- ENDIF -->
      <th>
        {fleets.MISSION_NAME}<br>
        <div class="z"><!-- IF fleets.OV_LABEL == 0 -->{L_ov_fleet_arrive}<!-- ELSEIF fleets.OV_LABEL == 1 -->{fleets.MISSION_NAME} - {L_ov_fleet_hold}<!-- ELSEIF fleets.OV_LABEL == 2 -->{L_ov_fleet_return}<!-- ELSEIF fleets.OV_LABEL == 3 -->{L_ov_fleet_rocket}<!-- ENDIF --></div>
      </th>
    </tr>

    <script type="text/javascript"><!--
      sn_timers.unshift(
        {
          id: 'ov_fleer_timer_{$OV_FLEET_ACTION}{fleets.ID}', 
          type: 0, 
          active: true, 
          start_time: {TIME_NOW}, 
          options: 
            {msg_done: '{L_sys_fleet_arrived}',
              que:
                [
                  ['{fleets.ID}', '', {fleets.OV_LEFT}, '0']
                ]
            }
        }
      );
    --></script>
  <!-- ENDIF -->
  <!-- BEGINELSE fleets -->
    <tr><th colspan=5>{L_ov_fleet_no_flying}</th></tr>
  <!-- END fleets -->
</table>
