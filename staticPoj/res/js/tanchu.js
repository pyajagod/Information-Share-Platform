	// JavaScript Document
 /**
     * [显示/隐藏邀请框]
     * @param {string} toggle [block || none]
     */
    function toggleInvitingBox(toggle) {
      document.getElementById('invitingBox').style.display = toggle;
    }

    /**
     * [接受邀请，显示聊天窗口]
     */
    function inviteAccept() {
      toggleInvitingBox('none');
      clearTimeout(window._INVITE_LATER_TIMEOUT);
      var agentToken = document.getElementById('invitingBox').alt || '';
      _MEIQIA._SHOWPANEL({
        agentToken: agentToken
      });
      return false;
    }


    /**
     * [稍后邀请]
     * @param {number} time [几秒后再次出现]
     */
    function inviteLater(time) {
      toggleInvitingBox('none');
      window._INVITE_LATER_TIMEOUT = setTimeout(function() {
        toggleInvitingBox('block');
      }, 800000000000);
    }

    /**
     * [拒绝邀请]
     * @param {number} time [几秒后再次出现]
     */
    function inviteClose() {
      toggleInvitingBox('none');
    }


    /**
     * [美洽加载完成后，自动发起邀请]
     */
    function handleAllSet() {
      window._INVITE_ALLSET_TIMEOUT = setTimeout(function() {
        toggleInvitingBox('block');
      }, 800000000000);
    }

    /**
     * [处理邀请事件]
     * @param {string} agentToken [客服的 token]
     */
    function handleInviting(agentToken) {
      toggleInvitingBox('block');
      document.getElementById('invitingBox').alt = agentToken;
    }

    /**
     * [获取聊天窗的可见性来处理相关事件]
     */
    function handlePanelVisibility(visibility) {
		
      if (visibility === 'visible') { // 聊天窗处于可见状态
        // 清除邀请框的定时
        clearTimeout(window._INVITE_ALLSET_TIMEOUT);
        clearTimeout(window._INVITE_LATER_TIMEOUT);
        // 隐藏邀请框
        toggleInvitingBox('none');
      }
    }