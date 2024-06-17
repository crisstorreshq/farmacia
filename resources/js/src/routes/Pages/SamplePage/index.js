import React from 'react';
import Grid from '@material-ui/core/Grid';

import PageContainer from '../../../@jumbo/components/PageComponents/layouts/PageContainer';
import CmtCard from '../../../@coremat/CmtCard';
import CmtCardHeader from '../../../@coremat/CmtCard/CmtCardHeader';
import CmtCardContent from '../../../@coremat/CmtCard/CmtCardContent';

import LineBarAreaComposedChart from './../../../charts/LineBarAreaComposedChart'
import BrushBarChart from './../../../charts/BrushBarChart'
import SimpleAreaChart from './../../../charts/SimpleAreaChart'
import SimpleLineChart from './../../../charts/SimpleLineChart'

const breadcrumbs = [
  { label: "Página de Inicio", isActive: true },
];

const SamplePage = () => {
  return (
    <>
      <PageContainer heading="Página de Inicio" breadcrumbs={breadcrumbs}>
        <Grid item xs={12}>
          <CmtCard style={{"paddingTop":"10px","paddingBottom":"30px", "paddingRight":"10px", "paddingLeft":"10px"}}>
            <CmtCardHeader title={'BrushBarChart'} > </CmtCardHeader>
              <CmtCardContent>
                <BrushBarChart />
              </CmtCardContent>
            </CmtCard>
        </Grid>
        <br/>
        <Grid item xs={12}>
          <CmtCard style={{"paddingTop":"10px","paddingBottom":"30px", "paddingRight":"10px", "paddingLeft":"10px"}}>
          <CmtCardHeader title={'LineBarAreaComposedChart'} > </CmtCardHeader>
            <CmtCardContent>
                <LineBarAreaComposedChart />
            </CmtCardContent>
          </CmtCard>
        </Grid>
        <br/>
        <Grid item xs={12}>
          <CmtCard style={{"paddingTop":"10px","paddingBottom":"30px", "paddingRight":"10px", "paddingLeft":"10px"}}>
          <CmtCardHeader title={'SimpleLineChart'} > </CmtCardHeader>
            <CmtCardContent>
                <SimpleLineChart />
            </CmtCardContent>
          </CmtCard>
        </Grid>
        <br/>
        <Grid item xs={12}>
          <CmtCard style={{"paddingTop":"10px","paddingBottom":"30px", "paddingRight":"10px", "paddingLeft":"10px"}}>
          <CmtCardHeader title={'SimpleAreaChart'} > </CmtCardHeader>
            <CmtCardContent>
                <SimpleAreaChart />
            </CmtCardContent>
          </CmtCard>
        </Grid>
      </PageContainer>
    </>
  );
};

export default SamplePage;
