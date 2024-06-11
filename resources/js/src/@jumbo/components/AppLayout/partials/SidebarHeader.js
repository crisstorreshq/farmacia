import React, { useContext, useState, useEffect } from 'react';
import { MenuItem, MenuList, Paper, Popover, Typography } from '@material-ui/core';
import CmtAvatar from '../../../../@coremat/CmtAvatar';
import ArrowDropDownIcon from '@material-ui/icons/ArrowDropDown';
import makeStyles from '@material-ui/core/styles/makeStyles';
import ExitToAppIcon from '@material-ui/icons/ExitToApp';
import SidebarThemeContext from '../../../../@coremat/CmtLayouts/SidebarThemeContext/SidebarThemeContext';
import api from './../../../../helpers/api'

const useStyles = makeStyles(theme => ({
  root: {
    padding: '30px 16px 12px 16px',
    borderBottom: props => `solid 1px ${props.sidebarTheme.borderColor}`,
  },
  userInfo: {
    paddingTop: 24,
    transition: 'all 0.1s ease',
    height: 75,
    opacity: 1,
    '.Cmt-miniLayout .Cmt-sidebar-content:not(:hover) &': {
      height: 0,
      paddingTop: 0,
      opacity: 0,
      transition: 'all 0.3s ease',
    },
  },
  userTitle: {
    color: props => props.sidebarTheme.textDarkColor,
    marginBottom: 8,
  },
  userSubTitle: {
    fontSize: 14,
    fontWeight: theme.typography.fontWeightBold,
    letterSpacing: 0.25,
  },
}));

const SidebarHeader = () => {
  const [login, setLogin] = useState(null)
  const { sidebarTheme } = useContext(SidebarThemeContext);
  const classes = useStyles({ sidebarTheme });

  const [anchorEl, setAnchorEl] = useState(null);

  const handlePopoverOpen = event => {
    setAnchorEl(event.currentTarget);
  };

  const handlePopoverClose = () => {
    setAnchorEl(null);
  };

  const open = Boolean(anchorEl);

  const onLogoutClick = () => {
    api.logout()
      .then(data => {
        sessionStorage.clear()
        location.reload()
      })
      .catch(e => console.log(e))
  };

  const getLogin = () => {
    api.getAuth()
      .then(data => {
        setLogin(data.data)
      })
      .catch(e => console.log(e))
  }

  useEffect(() => {
    getLogin()
  }, [])

  return ( login && 
    <div className={classes.root}>
      <CmtAvatar src="images/auth/avatar.png" alt="User Avatar" />
      <div className={classes.userInfo} onClick={handlePopoverOpen}>
        <div
          className="pointer"
          style={{
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'flex-end',
          }}>
          <div className="mr-2">
            <Typography className={classes.userTitle} component="h3" variant="h6">
              {`${login.usuarios?.Segu_Usr_Nombre} ${login.usuarios?.Segu_Usr_ApellidoPaterno} ${login.usuarios?.Segu_Usr_ApellidoMaterno}`}
            </Typography>
            <Typography className={classes.userSubTitle}>{login.perfil?.unidad.servicio}</Typography>
          </div>
          <ArrowDropDownIcon />
        </div>
      </div>

      {open && (
        <Popover
          open={open}
          anchorEl={anchorEl}
          container={anchorEl}
          onClose={handlePopoverClose}
          anchorOrigin={{
            vertical: 'center',
            horizontal: 'right',
          }}
          transformOrigin={{
            vertical: 'center',
            horizontal: 'right',
          }}>
          <Paper elevation={8}>
            <MenuList>
              <MenuItem onClick={onLogoutClick}>
                <ExitToAppIcon />
                <div className="ml-2">Logout</div>
              </MenuItem>
            </MenuList>
          </Paper>
        </Popover>
      )}
    </div>
  );
};

export default SidebarHeader;
